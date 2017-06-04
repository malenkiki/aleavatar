<?php

/*
Copyright (c) 2013 Michel Petit <petit.michel@gmail.com>

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
"Software"), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
namespace Malenki\Aleavatar;

/**
 * Generate random avatar(s) to populate your websites!
 *
 * This allows you to create **identicons**, like you can see on
 * [Stackoverflow](http://stackoverflow.com/questions) for example. When user
 * has not set his own avatar yet, an identicon has created.
 *
 * But *Aleavatar* are more primitive shapes to generate more beautifull pictures.
 *
 * *Aleavatar* run using 256 primitive squares containing shapes, called
 * *units*. When an Aleavatar is created, it creates an **md5 sum** from the **given string**
 * or from **random string** if no string is given.
 *
 * On this **32 characters**, *Aleavatar* takes only **16 of them** like fallow:
 *
 * - the first is the index of the row to choose the **unit 1** ;
 *
 * - the second is the index of the column of the previous row to choose **unit 1** ;
 *
 * - the third and the fourth are like the two previous to choose **unit 2** ;
 *
 * - 5th and 6th are like before but for the **unit 3** ;
 *
 * - without surprise, 7th and 8th are for the **unit 4** :-)
 *
 * - **foreground color** is defined from 9th to 14th characters,
 *
 * - the last but one defines **how the 4 units take place into the first quarter** ;
 *
 * - the last defines **how each quarter is rotated**.
 *
 * Well, now you know the internal functionning, I can tell you it can output
 * picture like **SVG** or **PNG**. Please see this methods to learn more about how to
 * output your picture.
 *
 * One very important notice I have to tell you: If you want PNG outout, you
 * must have on your server
 * [ImageMagick](http://www.php.net/manual/fr/book.imagick.php) or
 * [GD](http://www.php.net/manual/fr/book.gmagick.php) PHP module. I
 * **strongly** recommand you the first one, **GD is used as fallback**
 * (Scaling and antialiasing are not available before PHP 5.5!).
 *
 * @property-read string $seed Seed used to create avatar
 * @property-read string $hash Hash of the seed
 * @author Michel Petit <petit.michel@gmail.com>
 * @license MIT
 */
class Aleavatar
{
    /**
     * Default size of identicon
     */
    const SIZE = 128;

    /**
     * Store background and foreground color.
     *
     * @var array
     * @access protected
     */
    protected $arr_colors = array();

    /**
     * Store top left, top right, bottom right and bottom left quarter parts.
     *
     * @var array
     * @access protected
     */
    protected $arr_quarters = array();

    /**
     * Store custom size.
     *
     * @var integer
     * @access protected
     */
    protected $size = self::SIZE;
    protected $seed = null;

    public function __get($name)
    {
        if ($name == 'seed') {
            return $this->seed->str;
        }

        if ($name == 'hash') {
            return $this->seed->hash;
        }
    }

    private function getFillOrder($code)
    {
        $arr = array(
            array(1,2,3,4),
            array(4,1,2,3),
            array(3,4,1,2),
            array(2,3,4,1),
            array(1,3,2,4),
            array(4,1,3,2),
            array(2,4,1,3),
            array(3,2,4,1),
            array(1,4,3,2),
            array(2,1,4,3),
            array(3,2,1,4),
            array(4,3,2,1),
            array(4,2,1,3),
            array(3,4,2,1),
            array(1,3,4,2),
            array(2,1,3,4)
        );

        return $arr[$code];
    }

    /**
     * Constructor, it generates the "seed" used to create identicon later.
     *
     * If no string given, a random seed is created.
     *
     * @param  string $str_seed The string used to create the seed.
     * @access public
     * @return void
     */
    public function __construct($str_seed = null)
    {
        $this->seed = new \stdClass();

        if (is_null($str_seed)) {
            date_default_timezone_set('UTC');

            $this->seed->str = date('YmdHis').uniqid();
            $this->seed->hash = md5($this->seed->str);
        } else {
            if (!is_scalar($str_seed)) {
                throw new \InvalidArgumentException('The seed must be a valid string.');
            }

            $str_seed = trim((string) $str_seed);

            if (strlen($str_seed) == 0) {
                throw new \InvalidArgumentException('String seed must not null string.');
            }

            $this->seed->str = $str_seed;
            $this->seed->hash = md5($str_seed);
        }
    }

    /**
     * Generate identicon internally.
     *
     * No image yet, but units are chosen, the way to place them and how to
     * rotate quarters too. The color is fixed, and an optional size can be set
     * here. If not set, the size will be 128 px.
     *
     * @param  integer   $size Size in pixels of the identicon
     * @access public
     * @return Aleavatar
     */
    public function generate($size = self::SIZE)
    {
        $this->size = $size;

        $str_base = '';

        // take 1 chars on 2
        foreach (str_split($this->seed->hash) as $k => $c) {
            if ($k % 2 == 1) {
                $str_base .= $c;
            }
        }

        $arr_base = str_split($str_base, 2);
        $arr_order = $this->getFillOrder(hexdec($arr_base[7][0]));
        $bool_rotate_way = hexdec($arr_base[7][1]) <= 8;

        $q = new Quarter(Quarter::TOP_LEFT, $bool_rotate_way);

        $color_bg = new Primitive\Color('FFFFFF');
        $color_fg = new Primitive\Color($arr_base[4].$arr_base[5].$arr_base[6]);

        $this->arr_colors[0] = $color_bg;
        $this->arr_colors[1] = $color_fg;

        foreach ($arr_order as $o) {
            list($rank1, $rank2) = str_split($arr_base[$o - 1]);

            $u = new Unit();

            $u->background($color_bg);
            $u->foreground($color_fg);
            $u->generate(hexdec($rank1), hexdec($rank2));

            $q->add($u);
        }

        // OK, first quarter is filled, so, let’s create the others!
        $this->arr_quarters[] = $q;
        $this->arr_quarters[] = $q->tr();
        $this->arr_quarters[] = $q->br();
        $this->arr_quarters[] = $q->bl();

        return $this;
    }

    /**
     * Output SVG map of all available units.
     *
     * Image output is a square of 16 × 16 units.
     *
     * @param  boolean $bool_for_html5 If true, output SVG string ready to be included into HTML5 document (without XML header)
     * @static
     * @access public
     * @return string
     */
    public static function mapSvg($bool_for_html5 = false)
    {
        $background = new Primitive\Color('FFFFFF');
        $foreground = new Primitive\Color('000000');

        $arr_out = array();

        if (!$bool_for_html5) {
            $arr_out[] = '<?xml version="1.0" encoding="utf-8"?>';
        }

        $arr_out[] = sprintf('<svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="%1$d" height="%1$d">', 16 * Unit::SIZE);
        $arr_out[] = '<title>All available units to create identicons</title>';
        $arr_out[] = '<desc>To learn more about this identicons, please visit https://github.com/malenkiki/aleavatar</desc>';

        foreach (range(0, 15) as $row) {
            foreach (range(0, 15) as $col) {
                $u = new Unit();
                $u->background($background);
                $u->foreground($foreground);

                try {
                    $u->generate($row, $col);
                    $arr_out[] = sprintf(
                        '<g transform="translate(%d, %d)">%s</g>',
                        $col * Unit::SIZE,
                        $row * Unit::SIZE,
                        $u->svg()
                    );
                } catch (\Exception $e) {
                    echo $e->getMessage() . "\n";
                }
            }
        }

        $arr_out[] = '</svg>';

        return implode("\n", $arr_out);
    }

    protected function toJpegOrPng($str_type = 'png', $str_filename = null, $int_quality = 90)
    {
        if(!in_array($str_type, array('png', 'jpeg', 'jpg')))
        {
            throw new \InvalidArgumentException('Type of format must be either png, jpeg or jpg.');
        }

        if($str_type == 'jpg')
        {
            $str_type = 'jpeg';
        }

        if (extension_loaded('imagick')) {
            $img = new \Imagick();
            $img->readImageBlob($this->svg());
            $img->setImageFormat($str_type == 'png' ? 'png24' : 'jpeg');

            if($str_type == 'jpeg')
            {
                if(
                    $int_quality < 0
                    ||
                    $int_quality > 100
                    ||
                    !is_integer($int_quality)
                )
                {
                    throw new \InvalidArgumentException('Compression quality must be a valid integer from 0 to 100.');
                }

                $img->setImageCompressionQuality($int_quality);
            }

            if (!is_null($str_filename)) {
                $img->writeImage($str_filename);
                $img->clear();
                $img->destroy();
            } else {
                ob_start();
                echo $img->getImageBlob();
                $contents =  ob_get_contents();
                ob_end_clean();
                $img->clear();
                $img->destroy();

                return $contents;
            }
        } else {
            $bool_has_imagick = false;

            if (function_exists('exec')) {
                if (is_writable(sys_get_temp_dir())) {
                    $int_return_code = null;
                    $arr_out = array();
                    exec("convert -version", $arr_out, $int_return_code);

                    $bool_has_imagick = $int_return_code == 0;
                } else {
                    throw new \RuntimeException('Cannot write to the temporary directory!');
                }
            }

            // ImageMagick software is available! yes!
            if ($bool_has_imagick) {
                $bool_as_output = false;
                $str_exec = 'convert %s %s';

                // Generates temporary SVG file
                $str_tmp_file = tempnam(sys_get_temp_dir(), 'aleavatar');
                $this->svg($str_tmp_file);

                // Convert temporary file to PNG temporary file of wanted file

                if (is_null($str_filename)) {
                    $bool_as_output = true;
                    $str_filename = sys_get_temp_dir() . DIRECTORY_SEPARATOR. uniqid() . '.' . $str_type;
                }

                $int_return_code = null;
                $arr_out = array();
                exec(
                    sprintf($str_exec, $str_tmp_file, $str_filename),
                    $arr_out,
                    $int_return_code
                );

                if ($int_return_code != 0) {
                    throw \RuntimeException('Can not creating PNG file!');
                }

                if ($bool_as_output) {
                    ob_start();
                    readfile($str_filename);
                    $contents =  ob_get_contents();
                    ob_end_clean();

                    return $contents;
                }
            } else {
                throw new \RuntimeException('Imagick extension is not available!');
            }
        }
    }

    /**
     * Output PNG image of the generated identicon.
     *
     * This method creates PNG you can display into browser by printing the
     * output or you can store the PNG into file if you give the filename.
     *
     * **Note:**
     *
     * If you have not **ImageMagick** PHP module, then *Aleavatar* tries to
     * run **convert** application. If convert is not found, then raises an 
     * Runtime Exception.
     *
     * @throws \RuntimeException If ImageMagick Application cannot write into temporary directory.
     * @throws \RuntimeException If ImageMagick is not available.
     * @param  string            $str_filename If given, save as PNG file
     * @access public
     * @return mixed             PNG data or void
     */
    public function png($str_filename = null)
    {
        return $this->toJpegOrPng('png', $str_filename);
    }


    /**
     * Output JPEG image of the generated identicon.
     *
     * This method creates JPEG you can display into browser by printing the
     * output or you can store the PNG into file if you give the filename.
     *
     * As second argument, you can set the compression level, with integer into 
     * the range [0, 100].
     *
     * **Note:**
     *
     * If you have not **ImageMagick** PHP module, then *Aleavatar* tries to
     * run **convert** application. If convert is not found, then raises an 
     * Runtime Exception.
     *
     * @use toJpegOrPng()
     * @param  string            $str_filename If given, save as JPEG file having this name
     * @param  integer           $int_quality If given, save JPEG using this compression level
     * @access public
     * @return mixed             JPEG data or void
     */
    public function jpeg($str_filename = null, $int_quality = 90)
    {
        return $this->toJpegOrPng('jpg', $str_filename, $int_quality);
    }

    /**
     * Outputs identicon has SVG string, to be used standalone.
     *
     * This can create a file too, but in all case output SVG with XML header.
     *
     * @param  string $str_filename Filename where to store it
     * @access public
     * @return string SVG code
     */
    public function svg($str_filename = null)
    {
        $str_svg = $this->svgForHtml5();
        $str_svg = '<?xml version="1.0" encoding="utf-8"?>'. "\n". $str_svg;

        if (!is_null($str_filename)) {
            file_put_contents($str_filename, $str_svg);
        }

        return $str_svg;
    }

    /**
     * Outputs SVG string to used it into HTML5 document.
     *
     * Generated SVG is without XML header.
     *
     * @access public
     * @return string SVG code
     */
    public function svgForHtml5()
    {
        $arr_svg = array();
        $arr_svg[] = sprintf('<svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="%1$d" height="%1$d">', $this->size);
        $arr_svg[] = sprintf('<title>Identicon of %s</title>', $this->seed->str);
        $arr_svg[] = sprintf('<desc>The hash string used to generate this identicon is %s.</desc>', $this->seed->hash);

        $arr_svg[] = sprintf(
            '<g transform="scale(%f)">',
            $this->size / self::SIZE
        );

        foreach ($this->arr_quarters as $k => $q) {
            $arr_svg[] = $q->svg();
        }
        $arr_svg[] = '</g>';
        $arr_svg[] = '</svg>';

        $str_svg = implode("\n", $arr_svg);

        return $str_svg;
    }

    /**
     * In string context, output full SVG code.
     *
     * @access public
     * @return string
     */
    public function __toString()
    {
        return $this->svg();
    }

}
