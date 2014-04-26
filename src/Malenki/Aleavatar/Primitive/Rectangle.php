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
 * Unlike Polygon objects, Rectangle uses only one point. This single point is
 * used to position the top left corner. Other parts of the rectangle are created using the `Rectangle::size()` method.
 *
 * @copyright 2013 Michel Petit
 * @author Michel Petit <petit.michel@gmail.com>
 * @license MIT
 */
class Rectangle
{
    /**
     * Standard class with properties `x` and `y` to store the top left
     * corner's coordinates.
     *
     * @var stdClass
     * @access protected
     */
    protected $point = null;



    /**
     * Stores rectangle's sizes width and height, into its properties `w` and `h`.
     *
     * @var stdClass
     * @access protected
     */
    protected $size = null;

    /**
     * Foreground color object.
     *
     * @var Color
     * @access protected
     */
    protected $color = null;

    /**
     * Constructor. It initializes inside point and size objects.
     *
     * @access public
     * @return void
     */
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
     * Sets one point by giving its coordinates.
     *
     * @param  integer                   $int_x
     * @param  integer                   $int_y
     * @throws \InvalidArgumentException If one of the two coordinate is not a positive integer.
     * @access public
     * @return Rectangle
     */
    public function point($int_x, $int_y)
    {
        if (is_double($int_x)) {
            $int_x = (integer) $int_x;
        }

        if (is_double($int_y)) {
            $int_y = (integer) $int_y;
        }
        if (!is_integer($int_x) || !is_integer($int_y) || $int_x < 0 || $int_y < 0) {
            throw new \InvalidArgumentException('Coordinates must be valid positive integers!');
        }

        $this->point->x = $int_x;
        $this->point->y = $int_y;

        return $this;
    }

    /**
     * Sets the size of the current rectangle.
     *
     * @param  integer                   $int_width
     * @param  integer                   $int_height
     * @throws \InvalidArgumentException If width or height is not a positive integer.
     * @access public
     * @return Rectangle
     */
    public function size($int_width, $int_height)
    {
        if (!is_integer($int_width) || !is_integer($int_height) || $int_width < 0 || $int_height < 0) {
            throw new \InvalidArgumentException('Width and height must be positive integers!');
        }

        $this->size->w = $int_width;
        $this->size->h = $int_height;

        return $this;
    }

    /**
     * Sets foreground color.
     *
     * @param  Color     $color
     * @access public
     * @return Rectangle
     */
    public function color($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Returns the current shape as a SVG primitive.
     *
     * @access public
     * @return string
     */
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

    /**
     * In string context, returns shape as SVG code.
     *
     * @access public
     * @return string
     * @see Rectangle::svg()
     */
    public function __toString()
    {
        return $this->svg();
    }

}
