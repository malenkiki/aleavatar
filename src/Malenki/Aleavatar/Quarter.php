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
 * Define a quarter part of the picture.
 *
 * @copyright 2013 Michel Petit
 * @author Michel Petit <petit.michel@gmail.com> 
 * @license MIT
 */
class Quarter
{
    const TOP_LEFT = 0;
    const TOP_RIGHT = 1;
    const BOTTOM_RIGHT = 2;
    const BOTTOM_LEFT = 3;
    const SIZE = 64;
    
    protected $type = self::TOP_LEFT;
    protected $arr_units = array();


    public function __construct($type = self::TOP_LEFT)
    {
        $this->type = $type;
    }


    public function tr()
    {
        $q = new self(self::TOP_RIGHT);
        $q->units($this->arr_units);
    }



    public function br()
    {
        $q = new self(self::BOTTOM_RIGHT);
        $q->units($this->arr_units);
    }



    public function bl()
    {
        $q = new self(self::BOTTOM_LEFT);
        $q->units($this->arr_units);
    }



    public function units($arr)
    {
        $this->arr_units = $arr;
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
        
        foreach($this->arr_units as $u)
        {
            $img_u = $u->png();
            
            $dst_x = 0;
            $dst_y = 0;

            if($k = 1)
            {
                $dst_x = Unit::SIZE;
                $dst_y = 0;
            }
            if($k = 2)
            {
                $dst_x = Unit::SIZE;
                $dst_y = Unit::SIZE;
            }
            if($k = 3)
            {
                $dst_x = 0;
                $dst_y = Unit::SIZE;
            }
            imagecopy($img, $img_u, $dst_x, $dst_y, 0, 0, Unit::SIZE, Unit::SIZE);
        }

        //imagepng($img, 'test.png');//DEBUG
        return $img;
    }



    public function svg()
    {
        $str_g = '';
        
        foreach($this->arr_units as $u)
        {
            $str_g .= $u->svg();
        }

        $str_attr_rotate = '';

        if($this->type != self::TOP_LEFT)
        {
            $str_attr_rotate = sprintf(
                ' style="rotate(%d, %d, %d);"',
                $this->type * 90,
                Unit::SIZE,
                Unit::SIZE
            );
        }

        return sprintf(
            '<g id="quarter-%d"%s>%s</g>',
            $str_g,
            $str_attr_rotate,
            $this->type
        );
    }
}
