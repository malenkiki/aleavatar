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
 * Define Pie shapes. 
 * 
 * @copyright 2013 Michel Petit
 * @author Michel Petit <petit.michel@gmail.com> 
 * @license MIT
 */
class Arc
{
    protected $center = null;
    protected $radius = null;
    protected $start = null;
    protected $angle = null;
    protected $color = null;



    public function __construct($int_x = 0, $int_y = 0)
    {
        $this->center = new \stdClass();
        $this->center->x = $int_x;
        $this->center->y = $int_y;
        
        $this->radius = new \stdClass();

        $this->angle = new \stdClass();
    }


    /**
     * Sets radius.
     *
     * If two values are provided, then n ellipse is defined.
     *
     * If only one value is given, then you get a circle. 
     * 
     * @param integer $int_rx 
     * @param integer $int_ry 
     * @throws InvalidArgumentException If radius is not an integer.
     * @access public
     * @return void
     */
    public function radius($int_rx, $int_ry = 0)
    {
        if(!is_integer($int_rx) || !is_integer($int_ry))
        {
            throw new \InvalidArgumentException('Radius must be integer value!');
        }


        if($int_ry == 0)
        {
            $this->radius->r = $int_rx;
            $this->radius->w = 2 * $int_rx;
            $this->radius->h = 2 * $int_rx;
            $this->radius->is_circle = true;
        }
        else
        {
            $this->radius->rx = $int_rx;
            $this->radius->ry = $int_ry;
            $this->radius->w = 2 * $int_rx;
            $this->radius->h = 2 * $int_ry;
            $this->radius->is_circle = false;
        }

        return $this;
    }



    public function start($int_angle = 0)
    {
        if($int_angle > 360 || $int_angle < -360)
        {
            throw new \InvalidArgumentException(
                'Angle must be value from -360 to 360'
            );
        }

        $this->start = $int_angle;
    }



    public function angle($int_angle = 90)
    {
        if($int_angle > 360 || $int_angle < -360)
        {
            throw new \InvalidArgumentException(
                'Angle must be value from -360 to 360'
            );
        }
        
        $this->start = $int_angle;
    }


    public function png(&$img)
    {
        imagefilledarc(
            $img ,
            $this->center->x ,
            $this->center->y ,
            $this->radius->w ,
            $this->radius->h ,
            -1 * ($this->angle + $this->start),
            -1 * $this->start, 
            $this->color,
            IMG_ARC_PIE
        );
    }



    public function svg()
    {
        // quarter TL
        //<path d="M32,32 L0,32 A32,32 0 0,1 32,0 z" fill="#ff0000" />
    }


}
