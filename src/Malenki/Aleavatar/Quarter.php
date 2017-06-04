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
 * Defines a quarter part of the picture.
 *
 * A Quarter is define by 4 Units.
 *
 * A quarter is defined by its position into the final picture and by its rotation way.
 *
 * @author Michel Petit <petit.michel@gmail.com>
 * @license MIT
 */
class Quarter
{
    /**
     * Type top left quarter.
     */
    const TOP_LEFT = 0;

    /**
     * Type top right quarter.
     */
    const TOP_RIGHT = 1;

    /**
     * Type bottom right quarter.
     */
    const BOTTOM_RIGHT = 2;

    /**
     * Type bottom left quarter.
     */
    const BOTTOM_LEFT = 3;

    /**
     * The quarter default size, `Quarter::SIZE = Aleavatar::SIZE / 2 = Unit::SIZE * 2`
     */
    const SIZE = 64;

    /**
     * Type of the current quarter. By default, is set to Quarter::TOP_LEFT.
     *
     * @see Quarter::TOP_LEFT
     * @see Quarter::TOP_RIGHT
     * @see Quarter::BOTTOM_LEFT
     * @see Quarter::BOTTOM_RIGHT
     * @var integer
     */
    protected $type = self::TOP_LEFT;

    /**
     * Store the 4 units composing the quarter.
     *
     * @see Unit
     * @var array
     */
    protected $arr_units = array();

    /**
     * Rotation way to apply to the current Quarter.
     *
     * @var boolean
     */
    protected $bool_rotate_way = true;

    /**
     * Constructor sets the rotation way and the type of quarter.
     *
     * Quarter type defines the position of the quarter into the final picture
     * of the rendered identicon. The rotation way is a boolean to define how
     * to rotate the quarter, counter clockwise or not.
     *
     * @see Quarter::TOP_LEFT
     * @see Quarter::TOP_RIGHT
     * @see Quarter::BOTTOM_LEFT
     * @see Quarter::BOTTOM_RIGHT
     * @param  mixed $type
     * @param  mixed $bool_rotate_way
     * @access public
     * @return void
     */
    public function __construct($type = self::TOP_LEFT, $bool_rotate_way)
    {
        $this->type = $type;
        $this->bool_rotate_way = $bool_rotate_way;
    }

    /**
     * Returns new quarter copied from current one and rotated for the top
     * right corner.
     *
     * @access public
     * @return Quarter
     */
    public function tr()
    {
        $q = new self(self::TOP_RIGHT, $this->bool_rotate_way);
        $q->units($this->arr_units);

        return $q;
    }

    /**
     * Returns new quarter copied from current one and rotated for the bottom
     * right corner.
     *
     * @access public
     * @return Quarter
     */
    public function br()
    {
        $q = new self(self::BOTTOM_RIGHT, $this->bool_rotate_way);
        $q->units($this->arr_units);

        return $q;
    }

    /**
     * Returns new quarter copied from current one and rotated for the bottom
     * left corner.
     *
     * @access public
     * @return Quarter
     */
    public function bl()
    {
        $q = new self(self::BOTTOM_LEFT, $this->bool_rotate_way);
        $q->units($this->arr_units);

        return $q;
    }

    /**
     * Sets all unit parts of the current quarter using an array.
     *
     * @param  array $arr
     * @access public
     * @return void
     */
    public function units($arr)
    {
        $this->arr_units = $arr;
    }

    /**
     * Adds one unit to the current quarter.
     *
     * @param  Unit $unit
     * @access public
     * @return void
     */
    public function add($unit)
    {
        $this->arr_units[] = $unit;
    }


    /**
     * SVG rendering.
     *
     * If quarter's type is different of Quarter::TOP_LEFT, a translation and a
     * rotation are apply.
     *
     * @access public
     * @return string SVG code
     */
    public function svg()
    {
        $str_g = '';

        foreach ($this->arr_units as $k => $u) {
            $int_dx = 0;
            $int_dy = 0;

            if ($k == self::TOP_RIGHT) {
                $int_dx = Unit::SIZE;
            } elseif ($k == self::BOTTOM_RIGHT) {
                $int_dx = Unit::SIZE;
                $int_dy = Unit::SIZE;
            } elseif ($k == self::BOTTOM_LEFT) {
                $int_dy = Unit::SIZE;
            }

            $str_attr_translate = sprintf(
                ' transform="translate(%d, %d)"',
                $int_dx,
                $int_dy
            );

            if ($int_dx || $int_dy) {
                $str_g .= sprintf('<g%s>%s</g>', $str_attr_translate, $u->svg()) . "\n";
            } else {
                $str_g .= $u->svg() . "\n";
            }
        }

        $str_attr = '';

        if ($this->type != self::TOP_LEFT) {
            $int_dx = 0;
            $int_dy = 0;

            if ($this->type == self::TOP_RIGHT) {
                $int_dx = self::SIZE;
            } elseif ($this->type == self::BOTTOM_RIGHT) {
                $int_dx = self::SIZE;
                $int_dy = self::SIZE;
            } elseif ($this->type == self::BOTTOM_LEFT) {
                $int_dy = self::SIZE;
            }

            $int_way = $this->bool_rotate_way ? -1 : 1;
            $str_attr = sprintf(
                ' transform="translate(%d, %d) rotate(%d, %d, %d)"',
                $int_dx,
                $int_dy,
                $this->type * 90 * $int_way,
                Unit::SIZE,
                Unit::SIZE
            );
        }

        return sprintf(
            '<g id="quarter-%d"%s>%s</g>'."\n",
            $this->type,
            $str_attr,
            $str_g
        );
    }
}
