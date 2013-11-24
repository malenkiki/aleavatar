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
 * Define one of the sixteen areas of the final avatar picture.
 * 
 * @copyright 2013 Michel Petit
 * @author Michel Petit <petit.michel@gmail.com> 
 * @license MIT
 */
class Unit
{
    const SIZE = 32;
    
    protected $arr_colors = array();
    protected $arr_primitives = array();


    protected function bg()
    {
        return $this->arr_colors[0];
    }

    protected function fg()
    {
        return $this->arr_colors[1];
    }



    public function __construct($id)
    {
        $this->id = $id;
    }



    public function background(\Malenki\Aleavatar\Primitive\Color $color)
    {
        $this->arr_colors[0] = $color;
    }



    public function foreground(\Malenki\Aleavatar\Primitive\Color $color)
    {
        $this->arr_colors[1] = $color;
    }

    public function generate($rank1, $rank2)
    {
        if($rank == 5)
        {
            $el = new Primitive\Ellipse();
            $el->point(0, 0);
            $el->radius(self::SIZE / 2);
            $el->color($this->fg());
            $this->arr_primitives[] = $el;
        }

        return $this;
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

        imagefill($img, 0, 0, $this->bg()->gd($img));
        
        foreach($this->arr_primitives as $p)
        {
            $p->png($img);
        }

        //imagepng($img, 'test.png');//DEBUG
        return $img;
    }

    public function svg()
    {
        $str_g = '';
        
        foreach($this->arr_primitives as $p)
        {
            $str_g .= $p->svg();
        }

        return sprintf('<g id="unit-%d">%s</g>', $str_g, $this->id);
    }
}
