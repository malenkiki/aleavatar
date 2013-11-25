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



if(!extension_loaded('gd'))
{
    throw new \RuntimeException('GD is not available! Aleavatar uses GD to work!');
}



/**
 * Generate random avatar(s) to populate your websites!
 *
 * @property-read string $seed Seed used to create avatar
 * @property-read string $hash Hash of the seed
 * @copyright 2013 Michel Petit
 * @author Michel Petit <petit.michel@gmail.com> 
 * @license MIT
 */
class Aleavatar
{
    const SIZE = 128;

    protected $arr_colors = array();
    protected $arr_quarters = array();
    protected $size = null;
    protected $seed = null;
    

    public function __get($name)
    {
        if($name == 'seed')
        {
            return $this->seed->str;
        }
        
        if($name == 'hash')
        {
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


    public function __construct($str_seed = null)
    {
        $this->size = new \stdClass();
        $this->size->width = self::SIZE;
        $this->size->height = self::SIZE;

        $this->seed = new \stdClass();

        if(is_null($str_seed))
        {
            date_default_timezone_set('UTC');

            $this->seed->str = date('YmdHis').uniqid();
            $this->seed->hash = md5($this->seed->str);
        }
        else
        {
            if(!is_string($str_seed))
            {
                throw new \InvalidArgumentException('The seed must be a valid string.');
            }

            $str_seed = trim($str_seed);

            if(strlen($str_seed) == 0)
            {
                throw new \InvalidArgumentException('String seed must not null string.');
            }

            $this->seed->str = $str_seed;
            $this->seed->hash = md5($str_seed);
        }
    }




    public function generate($width = null, $height = null)
    {
        $this->size->width = $width;
        $this->size->height = $height;

        $str_base = '';

        // take 1 chars on 2
        foreach(str_split($this->seed->hash) as $k => $c)
        {
            if($k % 2 == 1)
            {
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

        foreach($arr_order as $o)
        {
            list($rank1, $rank2) = str_split($arr_base[$o - 1]);

            $u = new Unit($o);
            
            $u->background($color_bg);
            $u->foreground($color_fg);
            //$u->generate(hexdec($rank1), hexdec($rank2));
            $u->generate(1, 0); //DEBUG
            //$u->generate(2, 3); //DEBUG

            $q->add($u);
        }

        // OK, first quarter is filled, so, let’s create the others!
        $this->arr_quarters[] = $q;
        $this->arr_quarters[] = $q->tr();
        $this->arr_quarters[] = $q->br();
        $this->arr_quarters[] = $q->bl();
    }


    
    public function png()
    {
        $img = imagecreatetruecolor(self::SIZE, self::SIZE);
        // Even if GD is installed, some systems have not this function
        // See http://stackoverflow.com/questions/5756144/imageantialias-call-to-undefined-function-error-with-gd-installed
        if(function_exists('imageantialias'))
        {
            imageantialias($img, true);
        }
        
        $this->arr_colors[0]->gd($img);    
        $this->arr_colors[1]->gd($img);    
        
        foreach($this->arr_quarters as $k => $q)
        {
            $img_q = $q->png();
            $this->arr_colors[0]->gd($img_q);    
            $this->arr_colors[1]->gd($img_q);    
            
            $dst_x = 0;
            $dst_y = 0;

            if($k == 1)
            {
                $dst_x = Quarter::SIZE;
                $dst_y = 0;
            }
            if($k == 2)
            {
                $dst_x = Quarter::SIZE;
                $dst_y = Quarter::SIZE;
            }
            if($k == 3)
            {
                $dst_x = 0;
                $dst_y = Quarter::SIZE;
            }
            imagecopy($img, $img_q, $dst_x, $dst_y, 0, 0, Quarter::SIZE, Quarter::SIZE);
            imagedestroy($img_q);
        }

        imagepng($img, 'test.png');//DEBUG
        //return $img; //DEBUG
    } 



    public function svg()
    {
        $arr_svg = array();
        $arr_svg[] = '<?xml version="1.0" encoding="utf-8"?>';
        $arr_svg[] = sprintf('<svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="%1$d" height="%1$d">', self::SIZE);
        $arr_svg[] = sprintf('<title>Identicon of %s</title>', $this->seed->str);
        $arr_svg[] = sprintf('<desc>The hash string used to generate this identicon is %s.</desc>', $this->seed->hash);

        foreach($this->arr_quarters as $k => $q)
        {
            $arr_svg[] = $q->svg();
        }

        $arr_svg[] = '</svg>';

        file_put_contents('test.svg', implode("\n", $arr_svg));
    }


    public function __toString()
    {
        return $this->svg();
    }

/*
    public function save($str_filename)
    {
        imagepng($this->image, $str_filename.'.png');
    }



    public function display()
    {
        header('Content-Type: image/png');
        $this->image = imagecreatetruecolor(12, 12);
        imagepng($this->image);
    }
    
    
    public function __destruct ()
    {
        imagedestroy($this->image);
        $this->image = null;
    }
 */
}
