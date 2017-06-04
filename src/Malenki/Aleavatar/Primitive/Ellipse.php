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
 * @author Michel Petit <petit.michel@gmail.com>
 * @license MIT
 */
class Ellipse
{
    /**
     * center point, as stdClass with properties `x` and `y`.
     *
     * @var stdClass
     * @access protected
     */
    protected $center = null;

    /**
     * Object that stores some information about the radius.
     *
     * If it is a circle, the properties will be `r` `w` `h` and if it is an
     * ellipse, will be `rx` `ry` `w` `h`. Both have `is_circle` property
     * boolean value.
     *
     * @var mixed
     * @access protected
     */
    protected $radius = null;

    /**
     * Stores color object
     *
     * @var Color
     * @access protected
     */
    protected $color = null;

    /**
     * Give the center point of the ellipse or the circle.
     *
     * @param  integer                   $int_x
     * @param  integer                   $int_y
     * @throws \InvalidArgumentException If coordinates are not positive integers.
     * @access public
     * @return Ellipse
     */
    public function __construct($int_x, $int_y)
    {
        if (is_double($int_x)) {
            $int_x = (integer) $int_x;
        }

        if (is_double($int_y)) {
            $int_y = (integer) $int_y;
        }

        if ((!is_integer($int_x) || !is_integer($int_y)) || $int_x < 0 || $int_y < 0) {
            throw new \InvalidArgumentException('Coordinates must be composed of two positive integers!');
        }

        $this->center = new \stdClass();
        $this->center->x = $int_x;
        $this->center->y = $int_y;

        return $this;
    }

    /**
     * Sets the foreground color.
     *
     * @param  Color   $color
     * @access public
     * @return Ellipse
     */
    public function color($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Sets radius.
     *
     * If two values are provided, then an ellipse is defined.
     *
     * If only one value is given, then you get a circle.
     *
     * @param  integer                   $int_rx
     * @param  integer                   $int_ry
     * @throws \InvalidArgumentException If radius is not an integer.
     * @access public
     * @return Ellipse
     */
    public function radius($int_rx, $int_ry = 0)
    {
        if (!is_integer($int_rx) || !is_integer($int_ry)) {
            throw new \InvalidArgumentException('Radius must be integer value!');
        }

        $this->radius = new \stdClass();

        if ($int_ry == 0) {
            $this->radius->r = $int_rx;
            $this->radius->w = 2 * $int_rx;
            $this->radius->h = 2 * $int_rx;
            $this->radius->is_circle = true;
        } else {
            $this->radius->rx = $int_rx;
            $this->radius->ry = $int_ry;
            $this->radius->w = 2 * $int_rx;
            $this->radius->h = 2 * $int_ry;
            $this->radius->is_circle = false;
        }

        return $this;
    }

    /**
     * Tests whether the current object is a circle.
     *
     * Note: if radius and/or center are not given, then this method returns `false`.
     *
     * @access public
     * @return boolean
     */
    public function isCircle()
    {
        if (is_null($this->radius)) {
            return false;
        }

        return $this->radius->is_circle;
    }

    /**
     * Tests whether the current object is an ellipse.
     *
     * Note: if radius and/or center are not given, then this method returns `false`.
     *
     * @access public
     * @return boolean
     */
    public function isEllipse()
    {
        if (is_null($this->radius)) {
            return false;
        }

        return !$this->isCircle();
    }

    /**
     * puts the current shape into given GD image resource.
     *
     * @throws \RuntimeException If radius is not set.
     * @param  resource          $img GD image
     * @access public
     * @return void
     */
    public function png(&$img)
    {
        if (is_null($this->center) || is_null($this->radius)) {
            throw new \RuntimeException('Before exporting to PNG, you must give center and radius!');
        }

        imagefilledellipse(
            $img,
            $this->center->x,
            $this->center->y,
            $this->radius->w,
            $this->radius->h,
            $this->color->gd($img)
        );
    }

    /**
     * Returns current object as an Ellipse or Circle primitive SCVG shape.
     *
     * @throws \RuntimeException If radius is not defined.
     * @access public
     * @return string            SVG code.
     */
    public function svg()
    {
        if (is_null($this->center) || is_null($this->radius)) {
            throw new \RuntimeException('Before exporting to SVG, you must give center and radius!');
        }

        if ($this->isCircle()) {
            return sprintf(
                '<circle cx="%d" cy="%d" r="%d" fill="%s" />',
                $this->center->x,
                $this->center->y,
                $this->radius->r,
                $this->color
            );
        }

        return sprintf(
            '<ellipse cx="%d" cy="%d" rx="%d" ry="%d" fill="%s" />',
            $this->center->x,
            $this->center->y,
            $this->radius->rx,
            $this->radius->ry,
            $this->color
        );
    }

    /**
     * In string context, returns the SVG rendering.
     *
     * @access public
     * @return string
     */
    public function __toString()
    {
        return $this->svg();
    }
}
