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

namespace Malenki\Aleavatar\Primitive;



/**
 * Define rectangle shapes. 
 * 
 * @copyright 2013 Michel Petit
 * @author Michel Petit <petit.michel@gmail.com> 
 * @license MIT
 */
class Rectangle
{
    protected $point = null;
    protected $size = null;
    protected $color = null;

    public function __construct()
    {
        $this->point = new \stdClass();
        $this->point->x = 0;
        $this->point->y = 0;
        $this->size = new \stdClass();
        $this->size->w = 0;
        $this->size->h = 0;
    }


    /**
     * Set one point by giving its coordinates. 
     * 
     * @param integer $int_x 
     * @param integer $int_y 
     * @access public
     * @return void
     */
    public function point($int_x, $int_y)
    {
        $this->point->x = $int_x;
        $this->point->y = $int_y;

        return $this;
    }



    public function size($int_width, $int_height)
    {
        $this->size->w = $int_width;
        $this->size->h = $int_height;

        return $this;
    }
    
    
    
    public function color($color)
    {
        $this->color = $color;

        return $this;
    }

    
    
    public function png(&$img)
    {
        imagefilledrectangle(
            $img,
            $this->point->x,
            $this->point->y, 
            $this->point->x + $this->size->w - 1, 
            $this->point->y + $this->size->h - 1, 
            $this->color->gd($img)
        );
    }
    

    public function svg()
    {
        return sprintf(
            '<rect x="%d" y="%d" width="%d" height="%d" fill="%s" />',
            $this->point->x,
            $this->point->y,
            $this->size->w,
            $this->size->h,
            $this->color
        );
    }


    public function __toString()
    {
        return $this->svg();
    }

}

