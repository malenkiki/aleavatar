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
 * Define ellipses and circles. 
 * 
 * @copyright 2013 Michel Petit
 * @author Michel Petit <petit.michel@gmail.com> 
 * @license MIT
 */
class Ellipse
{
    protected $point = null;
    protected $radius = null;
    
    protected $color = null;


    public function __construct()
    {
        $this->point = new \stdClass();
        $this->radius = new \stdClass();
    }



    public function point($x, $y)
    {
        $this->point->x = $x;
        $this->point->y = $y;
    }



    public function color($color)
    {
        $this->color = $color;
    }



    public function radius($int_rx, $int_ry = null)
    {
        if(is_null($int_ry))
        {
            $this->radius->r = $int_rx;
            $this->radius->isCircle = true;
        }
        else
        {
            $this->radius->rx = $int_rx;
            $this->radius->ry = $int_ry;
            $this->radius->isCircle = false;
        }
    }



    public function isCircle()
    {
        return $this->radius->isCircle;
    }
    


    public function isEllipse()
    {
        return !$this->isCircle();
    }



    public function png()
    {
    }



    public function svg()
    {

        $str_attr_points = implode(' ', $arr);
        // <ellipse cx="300" cy="80" rx="100" ry="50" style="fill:yellow;stroke:purple;stroke-width:2"/>
        //<circle cx="100" cy="50" r="40" stroke="black" stroke-width="2" fill="red"/>
        return sprintf('<polygon points="%s" style="fill:%s" />', $str_attr_points, $this->color);
    }



    public function __toString()
    {
        return $this->svg();
    }
}

