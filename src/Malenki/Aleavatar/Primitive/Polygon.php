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
    /**
     * Stores each point that polygon must contain. 
     * 
     * A point is an array of two integer elements, one for the X and one for 
     * the Y.
     *
     * @var array
     * @access protected
     */
    protected $arr_points = array();


    /**
     * Polygon's foreground color. 
     * 
     * @var Color
     * @access protected
     */
    protected $color = null;

    
    
    /**
     * Adds one point by giving it x and y coordinates. 
     * 
     * @param integer $int_x 
     * @param integer $int_y 
     * @throws \InvalidArgumentException If coordinates are not positive integers.
     * @access public
     * @return Polygon
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



    /**
     * Sets foreground color to the polygon.
     * 
     * @param Color $color
     * @access public
     * @return Polygon
     */
    public function color($color)
    {
        $this->color = $color;

        return $this;
    }



    /**
     * Adds the current polygonal shape to the given GD resource image.
     * 
     * **Notes:** If you have ImageMagick module installed, then this method is 
     * never used.
     *
     * @throws \RuntimeException If amount of point is less than 3.
     * @param resource $img GD resource image.
     * @access public
     * @return void
     */
    public function png(&$img)
    {
        if(count($this->arr_points) < 3)
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
    

    /**
     * Returns the SVG code part rendering the current polygon. 
     * 
     * @throws \RuntimeException If amount of point is less than 3.
     * @access public
     * @return void
     */
    public function svg()
    {
        if(count($this->arr_points) < 3)
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


    /**
     * In string context, renders the SVG code part for the current polygon. 
     * 
     * @see Polygon::svg()
     * @access public
     * @return string
     */
    public function __toString()
    {
        return $this->svg();
    }
}
