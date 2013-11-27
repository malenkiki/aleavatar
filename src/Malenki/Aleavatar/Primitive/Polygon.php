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
 * Define polygonal shapes. 
 * 
 * @copyright 2013 Michel Petit
 * @author Michel Petit <petit.michel@gmail.com> 
 * @license MIT
 */
class Polygon
{
    protected $arr_points = array();
    protected $color = null;

    
    
    /**
     * Add one point by giving it x and y coordinates. 
     * 
     * @param integer $int_x 
     * @param integer $int_y 
     * @throws InvalidArgumentException If coordinates are not positive integers.
     * @access public
     * @return void
     */
    public function point($int_x, $int_y)
    {
        if(is_double($int_x))
        {
            $int_x = (integer) $int_x;
        }

        if(is_double($int_y))
        {
            $int_y = (integer) $int_y;
        }

        if((!is_integer($int_x) || !is_integer($int_y)) || $int_x < 0 || $int_y < 0)
        {
            throw new \InvalidArgumentException('Coordinates must be composed of two positive integers!');
        }

        $this->arr_points[] = array($int_x, $int_y);

        return $this;
    }



    public function color($color)
    {
        $this->color = $color;

        return $this;
    }



    public function png(&$img)
    {
        if(count($this->arr_points) == 0)
        {
            throw new \RuntimeException('Before exporting to PNG, you must give at least 3 points!');
        }

        $arr= array();

        foreach($this->arr_points as $xy)
        {
            $arr[] = $xy[0];
            $arr[] = $xy[1];
        }

        imagefilledpolygon($img, $arr, count($this->arr_points), $this->color->gd($img));
    }
    

    public function svg()
    {
        if(count($this->arr_points) == 0)
        {
            throw new \RuntimeException('Before exporting to SVG, you must give at least 3 points!');
        }

        $arr = array();
        
        foreach($this->arr_points as $point)
        {
            $arr[] = implode(',', $point);
        }

        $str_attr_points = implode(' ', $arr);

        return sprintf('<polygon points="%s" style="fill:%s" />', $str_attr_points, $this->color);
    }


    public function __toString()
    {
        return $this->svg();
    }
}
