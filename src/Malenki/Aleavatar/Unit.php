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
 * At the identicon creation time, 4 of them are selected to populate the first
 * quarter, this quarter is then copied 3 times (with various rotation).
 *
 *
 * @author Michel Petit <petit.michel@gmail.com>
 * @license MIT
 */
class Unit
{
    const SIZE = 32;

    protected $arr_colors = array();
    protected $arr_primitives = array();

    /**
     * Add a primitive shape to the current unit.
     *
     *
     * @see Primitive\Diamond
     * @see Primitive\Ellipse
     * @see Primitive\Polygon
     * @see Primitive\Rectangle
     * @see Primitive\Square
     * @see Primitive\Triangle
     *
     * @param  mixed $p One object from the following classes: `Primitive\Diamond`, `Primitive\Ellipse`, `Primitive\Poligon`, `Primitive\Rectangle`, `Primitive\Square`, `Primitive\Triangle`.
     * @access protected
     * @return void
     */
    protected function add($p)
    {
        $this->arr_primitives[] = $p;
    }

    /**
     * Gets one already added primitive shape by giving its index.
     *
     * @param  int    $int_pos Position index of the primitive to get.
     * @access protected
     * @return Object
     */
    protected function get($int_pos = 0)
    {
        return $this->arr_primitives[$int_pos];
    }

    /**
     * Shorthand for Unit::get() method to get the last primitive shape of the
     * current unit.
     *
     * @access protected
     * @return Object
     */
    protected function last()
    {
        return $this->arr_primitives[count($this->arr_primitives) - 1];
    }

    /**
     * Get the background color of the current Unit.
     *
     * @access public
     * @return Primitive\Color
     */
    public function bg()
    {
        return $this->arr_colors[0];
    }

    /**
     * Get the foreground color of the current Unit.
     *
     * @access public
     * @return Primitive\Color
     */
    public function fg()
    {
        return $this->arr_colors[1];
    }

    /**
     * Set the Unit background color.
     *
     * The color is set by using Primitive\Color object.
     *
     * @param  \Malenki\Aleavatar\Primitive\Color $color
     * @access public
     * @return void
     */
    public function background(\Malenki\Aleavatar\Primitive\Color $color)
    {
        $this->arr_colors[0] = $color;
    }

    /**
     * Set the Unit foreground color.
     *
     * The color is set by using Primitive\Color object.
     *
     * @param  \Malenki\Aleavatar\Primitive\Color $color
     * @access public
     * @return void
     */
    public function foreground(\Malenki\Aleavatar\Primitive\Color $color)
    {
        $this->arr_colors[1] = $color;
    }

    /**
     * Selects one of the 16 units using various shapes.
     *
     * @param  integer $rank2 Column index
     * @access protected
     * @return void
     */
    protected function row0($rank2)
    {
        if ($rank2 == 0) {
            $this->row9(0);
            $p = new Primitive\Polygon();
            $p
                ->point(0, 0)
                ->point(self::SIZE / 4, 0)
                ->point(self::SIZE, self::SIZE)
                ->point(0, self::SIZE / 4)
                ->color($this->bg());

            $this->add($p);
        }
        if ($rank2 == 1) {
            $this->row9(1);
            $p = new Primitive\Polygon();
            $p
                ->point(self::SIZE * (3/4), 0)
                ->point(self::SIZE, 0)
                ->point(self::SIZE, self::SIZE / 4)
                ->point(0, self::SIZE)
                ->color($this->bg());

            $this->add($p);
        }
        if ($rank2 == 2) {
            $this->row9(2);
            $p = new Primitive\Polygon();
            $p
                ->point(0, 0)
                ->point(self::SIZE, self::SIZE * (3/4))
                ->point(self::SIZE, self::SIZE)
                ->point(self::SIZE * (3/4), self::SIZE)
                ->color($this->bg());

            $this->add($p);
        }
        if ($rank2 == 3) {
            $this->row9(3);
            $p = new Primitive\Polygon();
            $p
                ->point(0, self::SIZE * (3/4))
                ->point(self::SIZE, 0)
                ->point(self::SIZE / 4, self::SIZE)
                ->point(0, self::SIZE)
                ->color($this->bg());

            $this->add($p);
        }
        if ($rank2 == 4) {
            $this->row9(8);
            $p = new Primitive\Polygon();
            $p
                ->point(0, 0)
                ->point(self::SIZE / 4, 0)
                ->point(self::SIZE, self::SIZE)
                ->point(0, self::SIZE / 4)
                ->color($this->fg());

            $this->add($p);
        }
        if ($rank2 == 5) {
            $this->row9(9);
            $p = new Primitive\Polygon();
            $p
                ->point(self::SIZE * (3/4), 0)
                ->point(self::SIZE, 0)
                ->point(self::SIZE, self::SIZE / 4)
                ->point(0, self::SIZE)
                ->color($this->fg());

            $this->add($p);
        }
        if ($rank2 == 6) {
            $this->row9(10);
            $p = new Primitive\Polygon();
            $p
                ->point(0, 0)
                ->point(self::SIZE, self::SIZE * (3/4))
                ->point(self::SIZE, self::SIZE)
                ->point(self::SIZE * (3/4), self::SIZE)
                ->color($this->fg());

            $this->add($p);
        }
        if ($rank2 == 7) {
            $this->row9(11);
            $p = new Primitive\Polygon();
            $p
                ->point(0, self::SIZE * (3/4))
                ->point(self::SIZE, 0)
                ->point(self::SIZE / 4, self::SIZE)
                ->point(0, self::SIZE)
                ->color($this->fg());

            $this->add($p);
        }

        if ($rank2 == 8) {
            $this->row1(8);
            $this->row2(9);
        }
        if ($rank2 == 9) {
            $this->row1(9);
            $this->row2(8);
        }
        if ($rank2 == 10) {
            $this->row1(10);
            $this->row2(9);
            $this->get(5)->color($this->bg());
            $this->get(6)->color($this->bg());
        }
        if ($rank2 == 11) {
            $this->row1(11);
            $this->row2(8);
            $this->get(5)->color($this->bg());
            $this->get(6)->color($this->bg());
        }
        if ($rank2 == 12) {
            $this->row8(11);
            $d = new Primitive\Diamond();
            $d
                ->point(self::SIZE / 2, self::SIZE / 4)
                ->point(self::SIZE * (3/4), self::SIZE / 2)
                ->point(self::SIZE / 2, self::SIZE * (3/4))
                ->point(self::SIZE / 4, self::SIZE / 2)
                ->color($this->bg());

            $this->add($d);
        }
        if ($rank2 == 13) {
            $this->row8(12);
            $d = new Primitive\Diamond();
            $d
                ->point(self::SIZE / 2, self::SIZE / 4)
                ->point(self::SIZE * (3/4), self::SIZE / 2)
                ->point(self::SIZE / 2, self::SIZE * (3/4))
                ->point(self::SIZE / 4, self::SIZE / 2)
                ->color($this->bg());

            $this->add($d);
        }
        if ($rank2 == 14) {
            $this->row8(13);
            $d = new Primitive\Diamond();
            $d
                ->point(self::SIZE / 2, self::SIZE / 4)
                ->point(self::SIZE * (3/4), self::SIZE / 2)
                ->point(self::SIZE / 2, self::SIZE * (3/4))
                ->point(self::SIZE / 4, self::SIZE / 2)
                ->color($this->bg());

            $this->add($d);
        }
        if ($rank2 == 15) {
            $this->row8(14);
            $d = new Primitive\Diamond();
            $d
                ->point(self::SIZE / 2, self::SIZE / 4)
                ->point(self::SIZE * (3/4), self::SIZE / 2)
                ->point(self::SIZE / 2, self::SIZE * (3/4))
                ->point(self::SIZE / 4, self::SIZE / 2)
                ->color($this->bg());

            $this->add($d);
        }
    }

    /**
     * Select one of the 16 shapes with squares.
     *
     * @param  integer $rank2 Column index
     * @access protected
     * @return void
     */
    protected function row1($rank2)
    {
        // As void, so, square take all place and take background color.
        if ($rank2 == 0) {
            $c = new Primitive\Square();
            $c->point(0, 0)->size(Unit::SIZE)->color($this->bg());
            $this->add($c);
        }
        // As plain square
        if ($rank2 == 1) {
            $c = new Primitive\Square();
            $c->point(0, 0)->size(Unit::SIZE)->color($this->fg());
            $this->add($c);
        }
        // Mid sized suare TL
        if ($rank2 == 2) {
            $c = new Primitive\Square();
            $c->point(0, 0);
            $c->size(Unit::SIZE / 2);
            $c->color($this->fg());
            $this->add($c);
        }
        // Mid sized suare TR
        if ($rank2 == 3) {
            $c = new Primitive\Square();
            $c->point(Unit::SIZE / 2, 0);
            $c->size(Unit::SIZE / 2);
            $c->color($this->fg());
            $this->add($c);
        }
        // Mid sized suare BR
        if ($rank2 == 4) {
            $c = new Primitive\Square();
            $c->point(Unit::SIZE / 2, Unit::SIZE / 2);
            $c->size(Unit::SIZE / 2);
            $c->color($this->fg());
            $this->add($c);
        }
        // Mid sized suare BL
        if ($rank2 == 5) {
            $c = new Primitive\Square();
            $c->point(0, Unit::SIZE / 2);
            $c->size(Unit::SIZE / 2);
            $c->color($this->fg());
            $this->add($c);
        }
        // Mid sized squares TL + BR
        if ($rank2 == 6) {
            $this->row1(2);
            $this->row1(4);
        }
        // Mid sized squares TR + BL
        if ($rank2 == 7) {
            $this->row1(3);
            $this->row1(5);
        }
        // Little small square diagonal TL BR
        if ($rank2 == 8) {
            $c = new Primitive\Square();
            $c->point(0, 0);
            $c->size(Unit::SIZE / 4);
            $c->color($this->fg());
            $this->add($c);

            $c = new Primitive\Square();
            $c->point(Unit::SIZE / 4, Unit::SIZE / 4);
            $c->size(Unit::SIZE / 4);
            $c->color($this->fg());
            $this->add($c);

            $c = new Primitive\Square();
            $c->point(Unit::SIZE / 2, Unit::SIZE / 2);
            $c->size(Unit::SIZE / 4);
            $c->color($this->fg());
            $this->add($c);

            $c = new Primitive\Square();
            $c->point((int) ((3 / 4) * Unit::SIZE), (int) ((3 / 4) * Unit::SIZE));
            $c->size(Unit::SIZE / 4);
            $c->color($this->fg());
            $this->add($c);
        }
        // Little small square diagonal BL TR
        if ($rank2 == 9) {
            $c = new Primitive\Square();
            $c->point(0, (3 / 4) * Unit::SIZE);
            $c->size(Unit::SIZE / 4);
            $c->color($this->fg());
            $this->add($c);

            $c = new Primitive\Square();
            $c->point(Unit::SIZE / 4, Unit::SIZE / 2);
            $c->size(Unit::SIZE / 4);
            $c->color($this->fg());
            $this->add($c);

            $c = new Primitive\Square();
            $c->point(Unit::SIZE / 2, Unit::SIZE / 4);
            $c->size(Unit::SIZE / 4);
            $c->color($this->fg());
            $this->add($c);

            $c = new Primitive\Square();
            $c->point((3 / 4) * Unit::SIZE, 0);
            $c->size(Unit::SIZE / 4);
            $c->color($this->fg());
            $this->add($c);
        }
        // same as 8 but in reversed colors
        if ($rank2 == 10) {
            $c = new Primitive\Square();
            $c->point(0, 0)->size(Unit::SIZE)->color($this->fg());
            $this->add($c);

            $c = new Primitive\Square();
            $c->point(0, 0);
            $c->size(Unit::SIZE / 4);
            $c->color($this->bg());
            $this->add($c);

            $c = new Primitive\Square();
            $c->point(Unit::SIZE / 4, Unit::SIZE / 4);
            $c->size(Unit::SIZE / 4);
            $c->color($this->bg());
            $this->add($c);

            $c = new Primitive\Square();
            $c->point(Unit::SIZE / 2, Unit::SIZE / 2);
            $c->size(Unit::SIZE / 4);
            $c->color($this->bg());
            $this->add($c);

            $c = new Primitive\Square();
            $c->point((int) ((3 / 4) * Unit::SIZE), (int) ((3 / 4) * Unit::SIZE));
            $c->size(Unit::SIZE / 4);
            $c->color($this->bg());
            $this->add($c);
        }
        // same as 9 but in reversed colors
        if ($rank2 == 11) {
            $c = new Primitive\Square();
            $c->point(0, 0)->size(Unit::SIZE)->color($this->fg());
            $this->add($c);

            $c = new Primitive\Square();
            $c->point(0, (3 / 4) * Unit::SIZE);
            $c->size(Unit::SIZE / 4);
            $c->color($this->bg());
            $this->add($c);

            $c = new Primitive\Square();
            $c->point(Unit::SIZE / 4, Unit::SIZE / 2);
            $c->size(Unit::SIZE / 4);
            $c->color($this->bg());
            $this->add($c);

            $c = new Primitive\Square();
            $c->point(Unit::SIZE / 2, Unit::SIZE / 4);
            $c->size(Unit::SIZE / 4);
            $c->color($this->bg());
            $this->add($c);

            $c = new Primitive\Square();
            $c->point((3 / 4) * Unit::SIZE, 0);
            $c->size(Unit::SIZE / 4);
            $c->color($this->bg());
            $this->add($c);
        }

        // Mid sized suare TL reversed colors
        if ($rank2 == 12) {
            $c = new Primitive\Square();
            $c->point(0, 0)->size(Unit::SIZE)->color($this->fg());
            $this->add($c);

            $c = new Primitive\Square();
            $c->point(0, 0);
            $c->size(Unit::SIZE / 2);
            $c->color($this->bg());
            $this->add($c);
        }
        // Mid sized suare TR reversed colors
        if ($rank2 == 13) {
            $c = new Primitive\Square();
            $c->point(0, 0)->size(Unit::SIZE)->color($this->fg());
            $this->add($c);

            $c = new Primitive\Square();
            $c->point(Unit::SIZE / 2, 0);
            $c->size(Unit::SIZE / 2);
            $c->color($this->bg());
            $this->add($c);
        }
        // Mid sized suare BR
        if ($rank2 == 14) {
            $c = new Primitive\Square();
            $c->point(0, 0)->size(Unit::SIZE)->color($this->fg());
            $this->add($c);

            $c = new Primitive\Square();
            $c->point(Unit::SIZE / 2, Unit::SIZE / 2);
            $c->size(Unit::SIZE / 2);
            $c->color($this->bg());
            $this->add($c);
        }
        // Mid sized suare BL
        if ($rank2 == 15) {
            $c = new Primitive\Square();
            $c->point(0, 0)->size(Unit::SIZE)->color($this->fg());
            $this->add($c);

            $c = new Primitive\Square();
            $c->point(0, Unit::SIZE / 2);
            $c->size(Unit::SIZE / 2);
            $c->color($this->bg());
            $this->add($c);
        }
    }

    /**
     * Selects one of the 16 shapes with triangles.
     *
     * @param  integer $rank2 Column index
     * @access protected
     * @return void
     */
    protected function row2($rank2)
    {
        // Big triangle TL
        if ($rank2 == 0) {
            $c = new Primitive\Triangle();
            $c->point(0, 0);
            $c->point(Unit::SIZE, 0);
            $c->point(0, Unit::SIZE);
            $c->color($this->fg());
            $this->add($c);
        }
        // Big triangle TR
        if ($rank2 == 1) {
            $c = new Primitive\Triangle();
            $c->point(Unit::SIZE, 0);
            $c->point(Unit::SIZE, Unit::SIZE);
            $c->point(0, 0);
            $c->color($this->fg());
            $this->add($c);
        }
        // Big triangle BR
        if ($rank2 == 2) {
            $c = new Primitive\Triangle();
            $c->point(Unit::SIZE, 0);
            $c->point(Unit::SIZE, Unit::SIZE);
            $c->point(0, Unit::SIZE);
            $c->color($this->fg());
            $this->add($c);
        }
        // Big triangle BL
        if ($rank2 == 3) {
            $c = new Primitive\Triangle();
            $c->point(0, 0);
            $c->point(Unit::SIZE, Unit::SIZE);
            $c->point(0, Unit::SIZE);
            $c->color($this->fg());
            $this->add($c);
        }

        // triangle TL
        if ($rank2 == 4) {
            $c = new Primitive\Triangle();
            $c->point(0, 0);
            $c->point(Unit::SIZE / 2, 0);
            $c->point(0, Unit::SIZE / 2);
            $c->color($this->fg());
            $this->add($c);
        }
        // triangle TR
        if ($rank2 == 5) {
            $c = new Primitive\Triangle();
            $c->point(Unit::SIZE / 2, 0);
            $c->point(Unit::SIZE, Unit::SIZE / 2);
            $c->point(Unit::SIZE, 0);
            $c->color($this->fg());
            $this->add($c);
        }
        // triangle BR
        if ($rank2 == 6) {
            $c = new Primitive\Triangle();
            $c->point(Unit::SIZE, Unit::SIZE / 2);
            $c->point(Unit::SIZE, Unit::SIZE);
            $c->point(Unit::SIZE / 2, Unit::SIZE);
            $c->color($this->fg());
            $this->add($c);
        }
        // triangle BL
        if ($rank2 == 7) {
            $c = new Primitive\Triangle();
            $c->point(0, Unit::SIZE / 2);
            $c->point(Unit::SIZE / 2, Unit::SIZE);
            $c->point(0, Unit::SIZE);
            $c->color($this->fg());
            $this->add($c);
        }

        // 2  triangles TL BR
        if ($rank2 == 8) {
            $this->row2(4);
            $this->row2(6);
        }
        // 2  triangles TR BL
        if ($rank2 == 9) {
            $this->row2(5);
            $this->row2(7);
        }

        // 2  triangles TL TR
        if ($rank2 == 10) {
            $this->row2(4);
            $this->row2(5);
        }
        // 2  triangles BL BR
        if ($rank2 == 11) {
            $this->row2(6);
            $this->row2(7);
        }

        // 2  triangles TL BL
        if ($rank2 == 12) {
            $this->row2(4);
            $this->row2(7);
        }
        // 2  triangles TR BR
        if ($rank2 == 13) {
            $this->row2(5);
            $this->row2(6);
        }
        // 2 triangles CENTER TOP and BOTTOM
        if ($rank2 == 14) {
            $c = new Primitive\Triangle();
            $c->point(Unit::SIZE / 4, 0);
            $c->point(Unit::SIZE * (3/4), 0);
            $c->point(Unit::SIZE / 2, Unit::SIZE / 2);
            $c->color($this->fg());
            $this->add($c);
            $c = new Primitive\Triangle();
            $c->point(Unit::SIZE / 4, Unit::SIZE);
            $c->point(Unit::SIZE * (3/4), Unit::SIZE);
            $c->point(Unit::SIZE / 2, Unit::SIZE / 2);
            $c->color($this->fg());
            $this->add($c);
        }
        // 2 triangles CENTER LEFT and RIGHT
        if ($rank2 == 15) {
            $c = new Primitive\Triangle();
            $c->point(0, Unit::SIZE / 4);
            $c->point(0, Unit::SIZE * (3/4));
            $c->point(Unit::SIZE / 2, Unit::SIZE / 2);
            $c->color($this->fg());
            $this->add($c);
            $c = new Primitive\Triangle();
            $c->point(Unit::SIZE, Unit::SIZE / 4);
            $c->point(Unit::SIZE, Unit::SIZE * (3/4));
            $c->point(Unit::SIZE / 2, Unit::SIZE / 2);
            $c->color($this->fg());
            $this->add($c);
        }
    }

    /**
     * Selects one of the 16 units using rectangles
     *
     * @param  integer $rank2 Column index
     * @access public
     * @return void
     */
    public function row3($rank2)
    {
        // Big rectangle TOP
        if ($rank2 == 0) {
            $c = new Primitive\Rectangle();
            $c->point(0, 0);
            $c->size(Unit::SIZE, Unit::SIZE / 2);
            $c->color($this->fg());
            $this->add($c);
        }
        // Big rectangle BOTTOM
        if ($rank2 == 1) {
            $c = new Primitive\Rectangle();
            $c->point(0, Unit::SIZE / 2);
            $c->size(Unit::SIZE, Unit::SIZE / 2);
            $c->color($this->fg());
            $this->add($c);
        }
        // Big rectangle LEFT
        if ($rank2 == 2) {
            $c = new Primitive\Rectangle();
            $c->point(0, 0);
            $c->size(Unit::SIZE / 2, Unit::SIZE);
            $c->color($this->fg());
            $this->add($c);
        }
        // Big rectangle RIGHT
        if ($rank2 == 3) {
            $c = new Primitive\Rectangle();
            $c->point(Unit::SIZE / 2, 0);
            $c->size(Unit::SIZE / 2, Unit::SIZE);
            $c->color($this->fg());
            $this->add($c);
        }
        // Big rectangle MIDDLE
        if ($rank2 == 4) {
            $c = new Primitive\Rectangle();
            $c->point(0, Unit::SIZE / 4);
            $c->size(Unit::SIZE, Unit::SIZE / 2);
            $c->color($this->fg());
            $this->add($c);
        }
        // Big rectangle MIDDLE HORIZONTALY
        if ($rank2 == 5) {
            $c = new Primitive\Rectangle();
            $c->point(Unit::SIZE / 4, 0);
            $c->size(Unit::SIZE / 2, Unit::SIZE);
            $c->color($this->fg());
            $this->add($c);
        }
        // Long rectangle DIAGONAL BL TR
        if ($rank2 == 6) {
            $c = new Primitive\Polygon();
            $c->point((int) (Unit::SIZE * (3/4)), 0);
            $c->point(Unit::SIZE, (int) (Unit::SIZE * (1/4)));
            $c->point((int) (Unit::SIZE * (1/4)), Unit::SIZE);
            $c->point(0, (int) (Unit::SIZE * (3/4)));
            $c->color($this->fg());
            $this->add($c);
        }
        // Long rectangle DIAGONAL TL BR
        if ($rank2 == 7) {
            $c = new Primitive\Polygon();
            $c->point((int) (Unit::SIZE * (1/4)), 0);
            $c->point(Unit::SIZE, (int) (Unit::SIZE * (3/4)));
            $c->point((int) (Unit::SIZE * (3/4)), Unit::SIZE);
            $c->point(0, (int) (Unit::SIZE * (1/4)));
            $c->color($this->fg());
            $this->add($c);
        }
        // medium BL
        if ($rank2 == 8) {
            $c = new Primitive\Polygon();
            $c->point(self::SIZE / 2, self::SIZE / 4);
            $c->point(self::SIZE * (3/4), self::SIZE / 2);
            $c->point(self::SIZE / 4, self::SIZE);
            $c->point(0, self::SIZE * (3/4));
            $c->color($this->fg());
            $this->add($c);
        }
        // medium TL
        if ($rank2 == 9) {
            $c = new Primitive\Polygon();
            $c->point(self::SIZE / 4, 0);
            $c->point(self::SIZE * (3/4), self::SIZE / 2);
            $c->point(self::SIZE / 2, self::SIZE * (3/4));
            $c->point(0, self::SIZE / 4);
            $c->color($this->fg());
            $this->add($c);
        }
        // vertical grill of small rectangles
        if ($rank2 == 10) {
            $c = new Primitive\Rectangle();
            $c
                ->point(0, self::SIZE / 2)
                ->size(self::SIZE / 4, self::SIZE / 2)
                ->color($this->fg());

            $this->add($c);

            $c = new Primitive\Rectangle();
            $c
                ->point(self::SIZE / 4, 0)
                ->size(self::SIZE / 4, self::SIZE / 2)
                ->color($this->fg());

            $this->add($c);

            $c = new Primitive\Rectangle();
            $c
                ->point(self::SIZE / 2, self::SIZE / 2)
                ->size(self::SIZE / 4, self::SIZE / 2)
                ->color($this->fg());

            $this->add($c);

            $c = new Primitive\Rectangle();
            $c
                ->point(self::SIZE * (3/4), 0)
                ->size(self::SIZE / 4, self::SIZE / 2)
                ->color($this->fg());

            $this->add($c);
        }
        // vertical grill of small rectangles, other position
        if ($rank2 == 11) {
            $c = new Primitive\Rectangle();
            $c
                ->point(0, 0)
                ->size(self::SIZE / 4, self::SIZE / 2)
                ->color($this->fg());

            $this->add($c);

            $c = new Primitive\Rectangle();
            $c
                ->point(self::SIZE / 4, self::SIZE / 2)
                ->size(self::SIZE / 4, self::SIZE / 2)
                ->color($this->fg());

            $this->add($c);

            $c = new Primitive\Rectangle();
            $c
                ->point(self::SIZE / 2, 0)
                ->size(self::SIZE / 4, self::SIZE / 2)
                ->color($this->fg());

            $this->add($c);

            $c = new Primitive\Rectangle();
            $c
                ->point(self::SIZE * (3/4), self::SIZE / 2)
                ->size(self::SIZE / 4, self::SIZE / 2)
                ->color($this->fg());

            $this->add($c);
        }

        // horizontal grill of small rectngles
        if ($rank2 == 12) {
            $c = new Primitive\Rectangle();
            $c
                ->point(self::SIZE / 2, 0)
                ->size(self::SIZE / 2, self::SIZE / 4)
                ->color($this->fg());

            $this->add($c);

            $c = new Primitive\Rectangle();
            $c
                ->point(0, self::SIZE / 4)
                ->size(self::SIZE / 2, self::SIZE / 4)
                ->color($this->fg());

            $this->add($c);

            $c = new Primitive\Rectangle();
            $c
                ->point(self::SIZE / 2, self::SIZE / 2)
                ->size(self::SIZE / 2, self::SIZE / 4)
                ->color($this->fg());

            $this->add($c);

            $c = new Primitive\Rectangle();
            $c
                ->point(0, self::SIZE * (3/4))
                ->size(self::SIZE / 2, self::SIZE / 4)
                ->color($this->fg());

            $this->add($c);
        }

        // horizontal grill of small rectngles, other position
        if ($rank2 == 13) {
            $c = new Primitive\Rectangle();
            $c->point(0, 0)->size(Unit::SIZE / 2, Unit::SIZE / 4);
            $c->color($this->fg());
            $this->add($c);

            $c = new Primitive\Rectangle();
            $c->point(Unit::SIZE / 2, Unit::SIZE / 4);
            $c->size(Unit::SIZE / 2, Unit::SIZE / 4);
            $c->color($this->fg());
            $this->add($c);

            $c = new Primitive\Rectangle();
            $c->point(0, Unit::SIZE / 2);
            $c->size(Unit::SIZE / 2, Unit::SIZE / 4);
            $c->color($this->fg());
            $this->add($c);

            $c = new Primitive\Rectangle();
            $c->point(Unit::SIZE / 2, Unit::SIZE * (3/4));
            $c->size(Unit::SIZE / 2, Unit::SIZE / 4);
            $c->color($this->fg());
            $this->add($c);
        }
        // small TL
        if ($rank2 == 14) {
            $c = new Primitive\Rectangle();
            $c->point(0, 0)->size(Unit::SIZE / 2, Unit::SIZE / 4);
            $c->color($this->fg());
            $this->add($c);
        }
        // small BR
        if ($rank2 == 15) {
            $c = new Primitive\Rectangle();
            $c->point(Unit::SIZE / 2, Unit::SIZE * (3/4));
            $c->size(Unit::SIZE / 2, Unit::SIZE / 4);
            $c->color($this->fg());
            $this->add($c);
        }
    }

    /**
     * Select one of the 16 units with circles
     *
     * @param  integer $rank2 Column index
     * @return void
     */
    protected function row4($rank2)
    {
        // Mid sizes TL
        if ($rank2 == 0) {
            $el = new Primitive\Ellipse(self::SIZE / 4, self::SIZE / 4);
            $el->radius(self::SIZE / 4);
            $el->color($this->fg());
            $this->add($el);
        }
        // Mid sizes TR
        if ($rank2 == 1) {
            $el = new Primitive\Ellipse(self::SIZE * (3/4), self::SIZE / 4);
            $el->radius(self::SIZE / 4);
            $el->color($this->fg());
            $this->add($el);
        }
        // Mid sizes BR
        if ($rank2 == 2) {
            $el = new Primitive\Ellipse(self::SIZE * (3/4), self::SIZE * (3/4));
            $el->radius(self::SIZE / 4);
            $el->color($this->fg());
            $this->add($el);
        }
        // Mid sizes BL
        if ($rank2 == 3) {
            $el = new Primitive\Ellipse(self::SIZE / 4, self::SIZE * (3/4));
            $el->radius(self::SIZE / 4);
            $el->color($this->fg());
            $this->add($el);
        }
        if ($rank2 == 4) {
            $el = new Primitive\Ellipse(self::SIZE / 4, self::SIZE / 4);
            $el->radius(self::SIZE / 4);
            $el->color($this->fg());
            $this->add($el);
            $el = new Primitive\Ellipse(self::SIZE / 4, self::SIZE / 4);
            $el->radius(self::SIZE / 8);
            $el->color($this->bg());
            $this->add($el);
        }
        if ($rank2 == 5) {
            $el = new Primitive\Ellipse(self::SIZE * (3/4), self::SIZE / 4);
            $el->radius(self::SIZE / 4);
            $el->color($this->fg());
            $this->add($el);
            $el = new Primitive\Ellipse(self::SIZE * (3/4), self::SIZE / 4);
            $el->radius(self::SIZE / 8);
            $el->color($this->bg());
            $this->add($el);
        }
        if ($rank2 == 6) {
            $el = new Primitive\Ellipse(self::SIZE * (3/4), self::SIZE * (3/4));
            $el->radius(self::SIZE / 4);
            $el->color($this->fg());
            $this->add($el);
            $el = new Primitive\Ellipse(self::SIZE * (3/4), self::SIZE * (3/4));
            $el->radius(self::SIZE / 8);
            $el->color($this->bg());
            $this->add($el);
        }
        if ($rank2 == 7) {
            $el = new Primitive\Ellipse(self::SIZE / 4, self::SIZE * (3/4));
            $el->radius(self::SIZE / 4);
            $el->color($this->fg());
            $this->add($el);
            $el = new Primitive\Ellipse(self::SIZE / 4, self::SIZE * (3/4));
            $el->radius(self::SIZE / 8);
            $el->color($this->bg());
            $this->add($el);
        }
        if ($rank2 == 8) {
            $el = new Primitive\Ellipse(self::SIZE / 2, self::SIZE / 2);
            $el->radius(self::SIZE / 2);
            $el->color($this->fg());
            $this->add($el);
        }
        if ($rank2 == 9) {
            $this->row1(1);
            $el = new Primitive\Ellipse(self::SIZE / 2, self::SIZE / 2);
            $el->radius(self::SIZE / 2);
            $el->color($this->bg());
            $this->add($el);
        }
        if ($rank2 == 10) {
            $this->row4(8);
            $el = new Primitive\Ellipse(self::SIZE / 2, self::SIZE / 2);
            $el->radius(self::SIZE / 4);
            $el->color($this->bg());
            $this->add($el);
        }
        if ($rank2 == 11) {
            $this->row4(9);
            $el = new Primitive\Ellipse(self::SIZE / 2, self::SIZE / 2);
            $el->radius(self::SIZE / 4);
            $el->color($this->fg());
            $this->add($el);
        }
        if ($rank2 == 12) {
            $this->row4(10);
            $el = new Primitive\Ellipse(self::SIZE / 2, self::SIZE / 2);
            $el->radius(self::SIZE / 8);
            $el->color($this->fg());
            $this->add($el);
        }
        if ($rank2 == 13) {
            $this->row4(11);
            $el = new Primitive\Ellipse(self::SIZE / 2, self::SIZE / 2);
            $el->radius(self::SIZE / 8);
            $el->color($this->bg());
            $this->add($el);
        }
        if ($rank2 == 14) {
            $this->row4(0);
            $this->row4(2);
        }
        if ($rank2 == 15) {
            $this->row4(1);
            $this->row4(3);
        }

    }

    /**
     * Select one of 16 units containing various polygons shapes.
     *
     * @param  integer $rank2 Column index
     * @access public
     * @return void
     */
    public function row5($rank2)
    {
        // "squared" arrow TL
        if ($rank2 == 0) {
            $c = new Primitive\Polygon();
            $c->point(0, 0);
            $c->point(self::SIZE / 2, 0);
            $c->point(self::SIZE / 2, self::SIZE / 4);
            $c->point(self::SIZE * (3/4), self::SIZE * (3/4));
            $c->point(self::SIZE / 4, self::SIZE / 2);
            $c->point(0, self::SIZE / 2);
            $c->color($this->fg());
            $this->add($c);
        }
        // "squared" arrow TR
        if ($rank2 == 1) {
            $c = new Primitive\Polygon();
            $c->point(self::SIZE / 2, 0);
            $c->point(self::SIZE, 0);
            $c->point(self::SIZE, self::SIZE / 2);
            $c->point(self::SIZE * (3/4), self::SIZE / 2);
            $c->point(self::SIZE / 4, self::SIZE * (3/4));
            $c->point(self::SIZE / 2, self::SIZE / 4);
            $c->color($this->fg());
            $this->add($c);
        }
        // "squared" arrow BR
        if ($rank2 == 2) {
            $c = new Primitive\Polygon();
            $c->point(self::SIZE / 4, self::SIZE / 4);
            $c->point(self::SIZE * (3/4), self::SIZE / 2);
            $c->point(self::SIZE, self::SIZE / 2);
            $c->point(self::SIZE, self::SIZE);
            $c->point(self::SIZE / 2, self::SIZE);
            $c->point(self::SIZE / 2, self::SIZE * (3/4));
            $c->color($this->fg());
            $this->add($c);
        }
        // "squared" arrow BL
        if ($rank2 == 3) {
            $c = new Primitive\Polygon();
            $c->point(0, self::SIZE / 2);
            $c->point(self::SIZE / 4, self::SIZE / 2);
            $c->point(self::SIZE *(3/4), self::SIZE / 4);
            $c->point(self::SIZE / 2, self::SIZE * (3/4));
            $c->point(self::SIZE / 2, self::SIZE);
            $c->point(0, self::SIZE);
            $c->color($this->fg());
            $this->add($c);
        }
        // same as row5 for 0
        if ($rank2 == 4) {
            $this->row1(1);
            $this->row5(0);
            $this->last()->color($this->bg());
        }
        // same as row5 for 1
        if ($rank2 == 5) {
            $this->row1(1);
            $this->row5(1);
            $this->last()->color($this->bg());
        }
        // same as row5 for 2
        if ($rank2 == 6) {
            $this->row1(1);
            $this->row5(2);
            $this->last()->color($this->bg());
        }
        // same as row5 for 3
        if ($rank2 == 7) {
            $this->row1(1);
            $this->row5(3);
            $this->last()->color($this->bg());
        }
        // 4 sides shape TL
        if ($rank2 == 8) {
            $c = new Primitive\Polygon();
            $c->point(0, 0);
            $c->point(self::SIZE / 2, 0);
            $c->point(self::SIZE / 2, self::SIZE / 2);
            $c->point(0, self::SIZE * (3/4));
            $c->color($this->fg());
            $this->add($c);
        }
        // same as previous, in reversed colors
        if ($rank2 == 9) {
            $this->row1(1);
            $this->row5(8);
            $this->last()->color($this->bg());
        }
        // 4 sides shape TR
        if ($rank2 == 10) {
            $c = new Primitive\Polygon();
            $c->point(self::SIZE / 4, 0);
            $c->point(self::SIZE, 0);
            $c->point(self::SIZE, self::SIZE / 2);
            $c->point(self::SIZE / 2, self::SIZE / 2);
            $c->color($this->fg());
            $this->add($c);
        }
        // same as previous, in reversed colors
        if ($rank2 == 11) {
            $this->row1(1);
            $this->row5(10);
            $this->last()->color($this->bg());
        }
        // 4 sides shape BR
        if ($rank2 == 12) {
            $c = new Primitive\Polygon();
            $c->point(self::SIZE / 2, self::SIZE / 2);
            $c->point(self::SIZE, self::SIZE / 4);
            $c->point(self::SIZE, self::SIZE);
            $c->point(self::SIZE / 2, self::SIZE);
            $c->color($this->fg());
            $this->add($c);
        }
        // same as previous, in reversed colors
        if ($rank2 == 13) {
            $this->row1(1);
            $this->row5(12);
            $this->last()->color($this->bg());
        }
        // 4 sides shape BL
        if ($rank2 == 14) {
            $c = new Primitive\Polygon();
            $c->point(0, self::SIZE / 2);
            $c->point(self::SIZE / 2, self::SIZE / 2);
            $c->point(self::SIZE * (3/4), self::SIZE);
            $c->point(0, self::SIZE);
            $c->color($this->fg());
            $this->add($c);
        }
        // same as previous, in reversed colors
        if ($rank2 == 15) {
            $this->row1(1);
            $this->row5(14);
            $this->last()->color($this->bg());
        }
    }

    /**
     * Selects one unit from 16 with various triangle shapes.
     *
     * @param  integer $rank2 Column index
     * @access public
     * @return void
     */
    public function row6($rank2)
    {
        // Big long triangle LEFT
        if ($rank2 == 0) {
            $t = new Primitive\Triangle();
            $t->point(0, 0);
            $t->point(self::SIZE / 2, self::SIZE);
            $t->point(0 , self::SIZE);
            $t->color($this->fg());
            $this->add($t);
        }
        // Big long triangle TOP
        if ($rank2 == 1) {
            $t = new Primitive\Triangle();
            $t->point(0, 0);
            $t->point(self::SIZE, 0);
            $t->point(0 , self::SIZE / 2);
            $t->color($this->fg());
            $this->add($t);
        }
        // Big long triangle RIGHT
        if ($rank2 == 2) {
            $t = new Primitive\Triangle();
            $t->point(self::SIZE / 2, 0);
            $t->point(self::SIZE, 0);
            $t->point(self::SIZE , self::SIZE);
            $t->color($this->fg());
            $this->add($t);
        }
        // Big long triangle BOTTOM
        if ($rank2 == 3) {
            $t = new Primitive\Triangle();
            $t->point(self::SIZE, self::SIZE / 2);
            $t->point(self::SIZE, self::SIZE);
            $t->point(0, self::SIZE);
            $t->color($this->fg());
            $this->add($t);
        }
        // Same as 0, reversed colors
        if ($rank2 == 4) {
            $this->row1(1);
            $this->row6(0);
            $this->last()->color($this->bg());
        }
        // Same as 1, reversed colors
        if ($rank2 == 5) {
            $this->row1(1);
            $this->row6(1);
            $this->last()->color($this->bg());
        }
        // Same as 2, reversed colors
        if ($rank2 == 6) {
            $this->row1(1);
            $this->row6(2);
            $this->last()->color($this->bg());
        }
        // Same as 3, reversed colors
        if ($rank2 == 7) {
            $this->row1(1);
            $this->row6(3);
            $this->last()->color($this->bg());
        }
        // 2 long triangles LEFT
        if ($rank2 == 8) {
            $this->row6(0);
            $t = new Primitive\Triangle();
            $t->point(self::SIZE / 2, 0);
            $t->point(self::SIZE, self::SIZE);
            $t->point(self::SIZE / 2, self::SIZE);
            $t->color($this->fg());
            $this->add($t);
        }
        // 2 long triangles TOP
        if ($rank2 == 9) {
            $this->row6(1);
            $t = new Primitive\Triangle();
            $t->point(0, self::SIZE / 2);
            $t->point(self::SIZE, self::SIZE / 2);
            $t->point(0, self::SIZE);
            $t->color($this->fg());
            $this->add($t);
        }
        // 2 long triangles RIGHT
        if ($rank2 == 10) {
            $this->row6(2);
            $t = new Primitive\Triangle();
            $t->point(0, 0);
            $t->point(self::SIZE / 2, 0);
            $t->point(self::SIZE / 2, self::SIZE);
            $t->color($this->fg());
            $this->add($t);
        }
        // 2 long triangles BOTTOM
        if ($rank2 == 11) {
            $this->row6(3);
            $t = new Primitive\Triangle();
            $t->point(0, self::SIZE / 2);
            $t->point(self::SIZE, 0);
            $t->point(self::SIZE, self::SIZE / 2);
            $t->color($this->fg());
            $this->add($t);
        }
        // 2 long crossed triangles
        if ($rank2 == 12) {
            $t = new Primitive\Triangle();
            $t->point(0, self::SIZE / 2);
            $t->point(self::SIZE, 0);
            $t->point(0, self::SIZE);
            $t->color($this->fg());
            $this->add($t);

            $t = new Primitive\Triangle();
            $t->point(0, 0);
            $t->point(self::SIZE, self::SIZE / 2);
            $t->point(self::SIZE, self::SIZE);
            $t->color($this->fg());
            $this->add($t);
        }
        // 2 big flat triangles
        if ($rank2 == 13) {
            $t = new Primitive\Triangle();
            $t->point(0, 0);
            $t->point(self::SIZE / 2,  self::SIZE / 2);
            $t->point(0, self::SIZE);
            $t->color($this->fg());
            $this->add($t);
            $t = new Primitive\Triangle();
            $t->point(self::SIZE / 2, 0);
            $t->point(self::SIZE,  self::SIZE / 2);
            $t->point(self::SIZE / 2, self::SIZE);
            $t->color($this->fg());
            $this->add($t);
        }
        // 4 triangle in cross
        if ($rank2 == 14) {
            //TL
            $t = new Primitive\Triangle();
            $t->point(0, 0);
            $t->point(self::SIZE / 2,  self::SIZE / 4);
            $t->point(self::SIZE / 4, self::SIZE / 2);
            $t->color($this->fg());
            $this->add($t);
            //TR
            $t = new Primitive\Triangle();
            $t->point(self::SIZE / 2, self::SIZE / 4);
            $t->point(self::SIZE,  0);
            $t->point(self::SIZE *(3/4), self::SIZE / 2);
            $t->color($this->fg());
            $this->add($t);
            //BR
            $t = new Primitive\Triangle();
            $t->point(self::SIZE * (3/4), self::SIZE / 2);
            $t->point(self::SIZE,  self::SIZE);
            $t->point(self::SIZE / 2, self::SIZE * (3/4));
            $t->color($this->fg());
            $this->add($t);
            //BL
            $t = new Primitive\Triangle();
            $t->point(self::SIZE / 2, self::SIZE * (3/4));
            $t->point(0,  self::SIZE);
            $t->point(self::SIZE / 4, self::SIZE / 2);
            $t->color($this->fg());
            $this->add($t);
        }
        // Same as previous, but reversed
        if ($rank2 == 15) {
            $this->row1(1);
            $this->row6(14);
            $this->get(1)->color($this->bg());
            $this->get(2)->color($this->bg());
            $this->get(3)->color($this->bg());
            $this->get(4)->color($this->bg());
        }
    }

    /**
     * Select one unit from 16 containing circle shapes.
     *
     * @param  integer $rank2 Column index
     * @access public
     * @return void
     */
    public function row7($rank2)
    {
        // Circle inside other TOP
        if ($rank2 == 0) {
            $this->row4(8);
            $c = new Primitive\Ellipse(self::SIZE / 2, self::SIZE / 4);
            $c->radius(self::SIZE / 4)->color($this->bg());
            $this->add($c);
        }
        // Same as previous bu reversed
        if ($rank2 == 1) {
            $this->row1(1);
            $this->row7(0);
            $this->get(1)->color($this->bg());
            $this->get(2)->color($this->fg());
        }
        // Circle inside other RIGHT
        if ($rank2 == 2) {
            $this->row4(8);
            $c = new Primitive\Ellipse(self::SIZE * (3/4), self::SIZE / 2);
            $c->radius(self::SIZE / 4)->color($this->bg());
            $this->add($c);
        }
        // Same as previous but reversed
        if ($rank2 == 3) {
            $this->row1(1);
            $this->row7(2);
            $this->get(1)->color($this->bg());
            $this->get(2)->color($this->fg());
        }
        // Circle inside other BOTTOM
        if ($rank2 == 4) {
            $this->row4(8);
            $c = new Primitive\Ellipse(self::SIZE /2, self::SIZE * (3/4));
            $c->radius(self::SIZE / 4)->color($this->bg());
            $this->add($c);
        }
        // Same as previous but reversed
        if ($rank2 == 5) {
            $this->row1(1);
            $this->row7(4);
            $this->get(1)->color($this->bg());
            $this->get(2)->color($this->fg());
        }
        // Circle inside other LEFT
        if ($rank2 == 6) {
            $this->row4(8);
            $c = new Primitive\Ellipse(self::SIZE / 4, self::SIZE / 2);
            $c->radius(self::SIZE / 4)->color($this->bg());
            $this->add($c);
        }
        // Same as previous but reversed
        if ($rank2 == 7) {
            $this->row1(1);
            $this->row7(6);
            $this->get(1)->color($this->bg());
            $this->get(2)->color($this->fg());
        }
        if ($rank2 == 8) {
            // Moyen central
            $c = new Primitive\Ellipse(self::SIZE / 2, self::SIZE / 2);
            $c->radius(self::SIZE / 4)->color($this->fg());
            $this->add($c);
            //satellite TL
            $c = new Primitive\Ellipse(self::SIZE / 4, self::SIZE / 4);
            $c->radius(self::SIZE / 4)->color($this->fg());
            $this->add($c);
            //satellite TR
            $c = new Primitive\Ellipse(self::SIZE * (3/4), self::SIZE / 4);
            $c->radius(self::SIZE / 4)->color($this->fg());
            $this->add($c);
            //satellite BR
            $c = new Primitive\Ellipse(self::SIZE * (3/4), self::SIZE * (3/4));
            $c->radius(self::SIZE / 4)->color($this->fg());
            $this->add($c);
            //satellite BL
            $c = new Primitive\Ellipse(self::SIZE / 4, self::SIZE * (3/4));
            $c->radius(self::SIZE / 4)->color($this->fg());
            $this->add($c);
        }
        // same as previous but with central as negative
        if ($rank2 == 9) {
            $this->row7(8);
            $this->add($this->get(0)->color($this->bg()));
        }
        // same as 8, but satellites in negative
        if ($rank2 == 10) {
            $this->row7(8);
            $this->get(1)->color($this->bg());
            $this->get(2)->color($this->bg());
            $this->get(3)->color($this->bg());
            $this->get(4)->color($this->bg());
        }
        // Same as 8 with inside additionnal circles
        if ($rank2 == 11) {
            $this->row7(8);
            // small at center
            $c = new Primitive\Ellipse(self::SIZE / 2, self::SIZE / 2);
            $c->radius(self::SIZE / 8)->color($this->bg());
            $this->add($c);
            //satellite TL
            $c = new Primitive\Ellipse(self::SIZE / 4, self::SIZE / 4);
            $c->radius(self::SIZE / 8)->color($this->bg());
            $this->add($c);
            //satellite TR
            $c = new Primitive\Ellipse(self::SIZE * (3/4), self::SIZE / 4);
            $c->radius(self::SIZE / 8)->color($this->bg());
            $this->add($c);
            //satellite BR
            $c = new Primitive\Ellipse(self::SIZE * (3/4), self::SIZE * (3/4));
            $c->radius(self::SIZE / 8)->color($this->bg());
            $this->add($c);
            //satellite BL
            $c = new Primitive\Ellipse(self::SIZE / 4, self::SIZE * (3/4));
            $c->radius(self::SIZE / 8)->color($this->bg());
            $this->add($c);
        }
        if ($rank2 == 12) {
            $this->row4(8);
            $s = new Primitive\Rectangle();
            $s->point(0, self::SIZE / 2)->size(self::SIZE, self::SIZE / 2);
            $s->color($this->bg());
            $this->add($s);
        }
        if ($rank2 == 13) {
            $this->row4(8);
            $s = new Primitive\Rectangle();
            $s->point(0, 0)->size(self::SIZE, self::SIZE / 2);
            $s->color($this->bg());
            $this->add($s);
        }
        if ($rank2 == 14) {
            $this->row4(8);
            $s = new Primitive\Rectangle();
            $s->point(0, 0)->size(self::SIZE / 2, self::SIZE);
            $s->color($this->bg());
            $this->add($s);
        }
        if ($rank2 == 15) {
            $this->row4(8);
            $s = new Primitive\Rectangle();
            $s->point(self::SIZE / 2, 0)->size(self::SIZE / 2, self::SIZE);
            $s->color($this->bg());
            $this->add($s);
        }
    }

    /**
     * Various diamond shapes
     *
     * @param  integer $rank2 Column index
     * @access public
     * @return void
     */
    public function row8($rank2)
    {
        // big diamond
        if ($rank2 == 0) {
            $d = new Primitive\Diamond();
            $d
                ->point(self::SIZE / 2, 0)
                ->point(self::SIZE, self::SIZE / 2)
                ->point(self::SIZE / 2, self::SIZE)
                ->point(0, self::SIZE / 2)
                ->color($this->fg());

            $this->add($d);
        }

        // small TL
        if ($rank2 == 1) {
            $d = new Primitive\Diamond();
            $d
                ->point(self::SIZE / 4, 0)
                ->point(self::SIZE / 2, self::SIZE / 4)
                ->point(self::SIZE / 4, self::SIZE / 2)
                ->point(0, self::SIZE / 4)
                ->color($this->fg());

            $this->add($d);
        }

        // small TR
        if ($rank2 == 2) {
            $d = new Primitive\Diamond();
            $d
                ->point(self::SIZE * (3/4), 0)
                ->point(self::SIZE, self::SIZE / 4)
                ->point(self::SIZE * (3/4), self::SIZE / 2)
                ->point(self::SIZE / 2, self::SIZE / 4)
                ->color($this->fg());

            $this->add($d);
        }

        // small BR
        if ($rank2 == 3) {
            $d = new Primitive\Diamond();
            $d
                ->point(self::SIZE * (3/4), self::SIZE / 2)
                ->point(self::SIZE, self::SIZE * (3/4))
                ->point(self::SIZE * (3/4), self::SIZE)
                ->point(self::SIZE / 2, self::SIZE * (3/4))
                ->color($this->fg());

            $this->add($d);
        }

        // small BL
        if ($rank2 == 4) {
            $d = new Primitive\Diamond();
            $d
                ->point(self::SIZE / 4, self::SIZE / 2)
                ->point(self::SIZE / 2, self::SIZE * (3/4))
                ->point(self::SIZE / 4, self::SIZE)
                ->point(0, self::SIZE * (3/4))
                ->color($this->fg());

            $this->add($d);
        }

        // Small CENTER
        if ($rank2 == 5) {
            $d = new Primitive\Diamond();
            $d
                ->point(self::SIZE / 2, self::SIZE / 4)
                ->point(self::SIZE * (3/4), self::SIZE / 2)
                ->point(self::SIZE / 2, self::SIZE * (3/4))
                ->point(self::SIZE / 4, self::SIZE / 2)
                ->color($this->fg());

            $this->add($d);

            $d = new Primitive\Diamond();
            $d
                ->point(self::SIZE / 2, self::SIZE * (3/8))
                ->point(self::SIZE * (5/8), self::SIZE / 2)
                ->point(self::SIZE / 2, self::SIZE * (5/8))
                ->point(self::SIZE * (3/8), self::SIZE / 2)
                ->color($this->bg());

            $this->add($d);
        }

        // reversed small TL
        if ($rank2 == 6) {
            $this->row1(1);
            $this->row8(1);
            $this->last()->color($this->bg());
        }

        // reversed small TR
        if ($rank2 == 7) {
            $this->row1(1);
            $this->row8(2);
            $this->last()->color($this->bg());
        }

        // reversed small BR
        if ($rank2 == 8) {
            $this->row1(1);
            $this->row8(3);
            $this->last()->color($this->bg());
        }

        // reversed small BL
        if ($rank2 == 9) {
            $this->row1(1);
            $this->row8(4);
            $this->last()->color($this->bg());
        }

        // Big and center reversed
        if ($rank2 == 10) {
            $this->row8(0);
            $this->row13(0);
            $this->last()->color($this->bg());
        }

        // Long VERTICAL CENTER
        if ($rank2 == 11) {
            $d = new Primitive\Diamond();
            $d
                ->point(self::SIZE / 2, 0)
                ->point(self::SIZE * (3/4), self::SIZE / 2)
                ->point(self::SIZE / 2, self::SIZE)
                ->point(self::SIZE / 4, self::SIZE / 2)
                ->color($this->fg());

            $this->add($d);
        }

        // Long HORIZONTAL CENTER
        if ($rank2 == 12) {
            $d = new Primitive\Diamond();
            $d
                ->point(0, self::SIZE / 2)
                ->point(self::SIZE / 2, self::SIZE / 4)
                ->point(self::SIZE, self::SIZE / 2)
                ->point(self::SIZE / 2, self::SIZE * (3/4))
                ->color($this->fg());

            $this->add($d);
        }

        // Long DIAGONAL TL BR
        if ($rank2 == 13) {
            $d = new Primitive\Diamond();
            $d
                ->point(0, 0)
                ->point(self::SIZE * (3/4), self::SIZE / 4)
                ->point(self::SIZE, self::SIZE)
                ->point(self::SIZE / 4, self::SIZE * (3/4))
                ->color($this->fg());

            $this->add($d);
        }

        // Long DIAGONAL TR BL
        if ($rank2 == 14) {
            $d = new Primitive\Diamond();
            $d
                ->point(self::SIZE / 4, self::SIZE / 4)
                ->point(self::SIZE, 0)
                ->point(self::SIZE *(3/4), self::SIZE * (3/4))
                ->point(0, self::SIZE)
                ->color($this->fg());

            $this->add($d);
        }

        // 4 littles
        if ($rank2 == 15) {
            $this->row8(1);
            $this->row8(2);
            $this->row8(3);
            $this->row8(4);
        }
    }

    /**
     * Select one unit from a set of 16 polygons shapes.
     *
     * @param  integer $rank2 Column index
     * @access public
     * @return void
     */
    public function row9($rank2)
    {
        if ($rank2 == 0) {
            $p = new Primitive\Polygon();
            $p
                ->point(0, 0)
                ->point(self::SIZE / 2, 0)
                ->point(self::SIZE, self::SIZE)
                ->point(0, self::SIZE / 2)
                ->color($this->fg());

            $this->add($p);
        }
        if ($rank2 == 1) {
            $p = new Primitive\Polygon();
            $p
                ->point(self::SIZE / 2, 0)
                ->point(self::SIZE, 0)
                ->point(self::SIZE, self::SIZE / 2)
                ->point(0, self::SIZE)
                ->color($this->fg());

            $this->add($p);
        }
        if ($rank2 == 2) {
            $p = new Primitive\Polygon();
            $p
                ->point(0, 0)
                ->point(self::SIZE, self::SIZE / 2)
                ->point(self::SIZE, self::SIZE)
                ->point(self::SIZE / 2, self::SIZE)
                ->color($this->fg());

            $this->add($p);
        }
        if ($rank2 == 3) {
            $p = new Primitive\Polygon();
            $p
                ->point(0, self::SIZE / 2)
                ->point(self::SIZE, 0)
                ->point(self::SIZE / 2, self::SIZE)
                ->point(0, self::SIZE)
                ->color($this->fg());

            $this->add($p);
        }
        if ($rank2 == 4) {
            $p = new Primitive\Polygon();
            $p
                ->point(0, 0)
                ->point(self::SIZE / 2, self::SIZE / 4)
                ->point(self::SIZE, 0)
                ->point(self::SIZE * (3/4), self::SIZE / 2)
                ->point(self::SIZE, self::SIZE)
                ->point(self::SIZE / 2, self::SIZE * (3/4))
                ->point(0, self::SIZE)
                ->point(self::SIZE / 4, self::SIZE / 2)
                ->color($this->fg());

            $this->add($p);
        }
        if ($rank2 == 5) {
            $p = new Primitive\Polygon();
            $p
                ->point(0, 0)
                ->point(self::SIZE / 2, 0)
                ->point(self::SIZE / 2, self::SIZE / 4)
                ->point(0, self::SIZE / 2)
                ->color($this->fg());

            $this->add($p);

            $p = new Primitive\Polygon();
            $p
                ->point(self::SIZE / 2, self::SIZE * (3/4))
                ->point(self::SIZE, self::SIZE / 2)
                ->point(self::SIZE, self::SIZE)
                ->point(self::SIZE / 2, self::SIZE)
                ->color($this->fg());

            $this->add($p);
        }
        if ($rank2 == 6) {
            $p = new Primitive\Polygon();
            $p
                ->point(0, self::SIZE)
                ->point(self::SIZE / 2, 0)
                ->point(self::SIZE, self::SIZE)
                ->point(self::SIZE / 2, self::SIZE / 2)
                ->color($this->fg());

            $this->add($p);

        }
        if ($rank2 == 7) {
            $p = new Primitive\Polygon();
            $p
                ->point(self::SIZE / 4, self::SIZE / 4)
                ->point(self::SIZE / 2, 0)
                ->point(self::SIZE, 0)
                ->point(self::SIZE / 2, self::SIZE / 2)
                ->color($this->fg());

            $this->add($p);

            $p = new Primitive\Polygon();
            $p
                ->point(0, self::SIZE)
                ->point(self::SIZE / 2, self::SIZE / 2)
                ->point(self::SIZE * (3/4), self::SIZE * (3/4))
                ->point(self::SIZE / 2, self::SIZE)
                ->color($this->fg());

            $this->add($p);
        }
        if ($rank2 == 8) {
            $this->row1(1);
            $this->row9(0);
            $this->last()->color($this->bg());
        }
        if ($rank2 == 9) {
            $this->row1(1);
            $this->row9(1);
            $this->last()->color($this->bg());
        }
        if ($rank2 == 10) {
            $this->row1(1);
            $this->row9(2);
            $this->last()->color($this->bg());
        }
        if ($rank2 == 11) {
            $this->row1(1);
            $this->row9(3);
            $this->last()->color($this->bg());
        }
        if ($rank2 == 12) {
            $this->row1(1);
            $this->row9(4);
            $this->last()->color($this->bg());
        }
        if ($rank2 == 13) {
            $this->row1(1);
            $this->row9(5);
            $this->get(1)->color($this->bg());
            $this->get(2)->color($this->bg());
        }
        if ($rank2 == 14) {
            $this->row1(1);
            $this->row9(6);
            $this->last()->color($this->bg());
        }
        if ($rank2 == 15) {
            $this->row1(1);
            $this->row9(7);
            $this->get(1)->color($this->bg());
            $this->get(2)->color($this->bg());
        }
    }

    /**
     * Select one unit of triangle shapes.
     *
     * @param  integer $rank2 Column index
     * @access public
     * @return void
     */
    public function row10($rank2)
    {
        if ($rank2 == 0) {
            $t = new Primitive\Triangle();
            $t
                ->point(0, 0)
                ->point(self::SIZE, 0)
                ->point(self::SIZE / 2, self::SIZE / 2)
                ->color($this->fg());

            $this->add($t);

            $t = new Primitive\Triangle();
            $t
                ->point(0, self::SIZE / 2)
                ->point(self::SIZE, self::SIZE / 2)
                ->point(self::SIZE / 2, self::SIZE)
                ->color($this->fg());

            $this->add($t);
        }

        if ($rank2 == 1) {
            $t = new Primitive\Triangle();
            $t
                ->point(0, self::SIZE / 2)
                ->point(self::SIZE / 2, 0)
                ->point(self::SIZE / 2, self::SIZE)
                ->color($this->fg());

            $this->add($t);

            $t = new Primitive\Triangle();
            $t
                ->point(self::SIZE / 2, self::SIZE / 2)
                ->point(self::SIZE, 0)
                ->point(self::SIZE, self::SIZE)
                ->color($this->fg());

            $this->add($t);
        }
        if ($rank2 == 2) {
            $t = new Primitive\Triangle();
            $t
                ->point(self::SIZE / 2, 0)
                ->point(self::SIZE, self::SIZE / 2)
                ->point(0, self::SIZE / 2)
                ->color($this->fg());

            $this->add($t);

            $t = new Primitive\Triangle();
            $t
                ->point(self::SIZE / 2, self::SIZE / 2)
                ->point(self::SIZE, self::SIZE)
                ->point(0, self::SIZE)
                ->color($this->fg());

            $this->add($t);
        }
        if ($rank2 == 3) {
            $p = new Primitive\Polygon();
            $p
                ->point(0, 0)
                ->point(self::SIZE / 2, self::SIZE * (3/4))
                ->point(self::SIZE / 2, self::SIZE / 4)
                ->point(self::SIZE, self::SIZE)
                ->point(0, self::SIZE)
                ->color($this->fg());

            $this->add($p);
        }
        if ($rank2 == 4) {
            $p = new Primitive\Polygon();
            $p
                ->point(0, 0)
                ->point(self::SIZE, 0)
                ->point(self::SIZE / 4, self::SIZE / 2)
                ->point(self::SIZE * (3/4), self::SIZE / 2)
                ->point(0, self::SIZE)
                ->color($this->fg());

            $this->add($p);
        }
        if ($rank2 == 5) {
            $p = new Primitive\Polygon();
            $p
                ->point(0, 0)
                ->point(self::SIZE, 0)
                ->point(self::SIZE, self::SIZE)
                ->point(self::SIZE / 2, self::SIZE / 4)
                ->point(self::SIZE / 2, self::SIZE * (3/4))
                ->color($this->fg());

            $this->add($p);
        }
        if ($rank2 == 6) {
            $p = new Primitive\Polygon();
            $p
                ->point(0, self::SIZE)
                ->point(self::SIZE * (3/4), self::SIZE / 2)
                ->point(self::SIZE / 4, self::SIZE / 2)
                ->point(self::SIZE, 0)
                ->point(self::SIZE, self::SIZE)
                ->color($this->fg());

            $this->add($p);
        }
        if ($rank2 == 7) {
            $t = new Primitive\Triangle();
            $t
                ->point(0, self::SIZE / 2)
                ->point(self::SIZE / 2, self::SIZE * (3/4))
                ->point(0, self::SIZE)
                ->color($this->fg());

            $this->add($t);

            $t = new Primitive\Triangle();
            $t
                ->point(self::SIZE / 2, self::SIZE)
                ->point(self::SIZE * (3/4), self::SIZE / 2)
                ->point(self::SIZE, self::SIZE)
                ->color($this->fg());

            $this->add($t);

            $t = new Primitive\Triangle();
            $t
                ->point(self::SIZE / 2, self::SIZE / 4)
                ->point(self::SIZE, 0)
                ->point(self::SIZE, self::SIZE / 2)
                ->color($this->fg());

            $this->add($t);
        }
        if ($rank2 == 8) {
            $t = new Primitive\Triangle();
            $t
                ->point(0, 0)
                ->point(self::SIZE / 2, 0)
                ->point(self::SIZE / 4, self::SIZE / 2)
                ->color($this->fg());

            $this->add($t);

            $t = new Primitive\Triangle();
            $t
                ->point(0, self::SIZE / 2)
                ->point(self::SIZE / 2, self::SIZE * (3/4))
                ->point(0, self::SIZE)
                ->color($this->fg());

            $this->add($t);

            $t = new Primitive\Triangle();
            $t
                ->point(self::SIZE / 2, self::SIZE)
                ->point(self::SIZE * (3/4), self::SIZE / 2)
                ->point(self::SIZE, self::SIZE)
                ->color($this->fg());

            $this->add($t);
        }
        if ($rank2 == 9) {
            $t = new Primitive\Triangle();
            $t
                ->point(0, 0)
                ->point(self::SIZE / 2, 0)
                ->point(self::SIZE / 4, self::SIZE / 2)
                ->color($this->fg());

            $this->add($t);

            $t = new Primitive\Triangle();
            $t
                ->point(self::SIZE / 2, self::SIZE / 4)
                ->point(self::SIZE, 0)
                ->point(self::SIZE, self::SIZE / 2)
                ->color($this->fg());

            $this->add($t);

            $t = new Primitive\Triangle();
            $t
                ->point(0, self::SIZE / 2)
                ->point(self::SIZE / 2, self::SIZE * (3/4))
                ->point(0, self::SIZE)
                ->color($this->fg());

            $this->add($t);
        }
        if ($rank2 == 10) {
            $t = new Primitive\Triangle();
            $t
                ->point(0, 0)
                ->point(self::SIZE / 2, 0)
                ->point(self::SIZE / 4, self::SIZE / 2)
                ->color($this->fg());

            $this->add($t);

            $t = new Primitive\Triangle();
            $t
                ->point(self::SIZE / 2, self::SIZE / 4)
                ->point(self::SIZE, 0)
                ->point(self::SIZE, self::SIZE / 2)
                ->color($this->fg());

            $this->add($t);

            $t = new Primitive\Triangle();
            $t
                ->point(self::SIZE * (3/4), self::SIZE / 2)
                ->point(self::SIZE, self::SIZE)
                ->point(self::SIZE / 2, self::SIZE)
                ->color($this->fg());

            $this->add($t);
        }
        if ($rank2 == 11) {
            $t = new Primitive\Triangle();
            $t
                ->point(self::SIZE / 2, 0)
                ->point(self::SIZE, self::SIZE)
                ->point(0, self::SIZE)
                ->color($this->fg());

            $this->add($t);

            $t = new Primitive\Triangle();
            $t
                ->point(self::SIZE / 2, self::SIZE / 2)
                ->point(self::SIZE * (3/4), self::SIZE * (3/4))
                ->point(self::SIZE / 4, self::SIZE * (3/4))
                ->color($this->bg());

            $this->add($t);
        }
        if ($rank2 == 12) {
            $t = new Primitive\Triangle();
            $t
                ->point(0, 0)
                ->point(self::SIZE, self::SIZE / 2)
                ->point(0, self::SIZE)
                ->color($this->fg());

            $this->add($t);

            $t = new Primitive\Triangle();
            $t
                ->point(self::SIZE / 4, self::SIZE / 4)
                ->point(self::SIZE / 2, self::SIZE / 2)
                ->point(self::SIZE / 4, self::SIZE * (3/4))
                ->color($this->bg());

            $this->add($t);
        }
        if ($rank2 == 13) {
            $t = new Primitive\Triangle();
            $t
                ->point(0, 0)
                ->point(self::SIZE, 0)
                ->point(self::SIZE / 2, self::SIZE)
                ->color($this->fg());

            $this->add($t);

            $t = new Primitive\Triangle();
            $t
                ->point(self::SIZE / 4, self::SIZE / 4)
                ->point(self::SIZE * (3/4), self::SIZE / 4)
                ->point(self::SIZE / 2, self::SIZE / 2)
                ->color($this->bg());

            $this->add($t);
        }
        if ($rank2 == 14) {
            $t = new Primitive\Triangle();
            $t
                ->point(0, self::SIZE / 2)
                ->point(self::SIZE, 0)
                ->point(self::SIZE, self::SIZE)
                ->color($this->fg());

            $this->add($t);

            $t = new Primitive\Triangle();
            $t
                ->point(self::SIZE * (3/4), self::SIZE / 4)
                ->point(self::SIZE * (3/4), self::SIZE * (3/4))
                ->point(self::SIZE / 2, self::SIZE / 2)
                ->color($this->bg());

            $this->add($t);
        }
        if ($rank2 == 15) {
            $this->row1(1);
            $this->row6(12);
            $this->get(1)->color($this->bg());
            $this->get(2)->color($this->bg());
        }
    }

    public function row11($rank2)
    {
        if ($rank2 == 0) {
            $p = new Primitive\Polygon();
            $p
                ->point(0, self::SIZE / 2)
                ->point(self::SIZE / 2 , 0)
                ->point(self::SIZE, 0)
                ->point(self::SIZE, self::SIZE / 2)
                ->point(self::SIZE / 2, self::SIZE / 2)
                ->point(self::SIZE / 2, self::SIZE)
                ->point(0, self::SIZE)
                ->color($this->fg());

            $this->add($p);
        }
        if ($rank2 == 1) {
            $this->row1(1);
            $this->row11(0);
            $this->last()->color($this->bg());
        }
        if ($rank2 == 2) {
            $p = new Primitive\Polygon();
            $p
                ->point(0, 0)
                ->point(self::SIZE / 2 , 0)
                ->point(self::SIZE, self::SIZE / 2)
                ->point(self::SIZE, self::SIZE)
                ->point(self::SIZE / 2, self::SIZE)
                ->point(self::SIZE / 2, self::SIZE / 2)
                ->point(0, self::SIZE / 2)
                ->color($this->fg());

            $this->add($p);
        }
        if ($rank2 == 3) {
            $this->row1(1);
            $this->row11(2);
            $this->last()->color($this->bg());
        }
        if ($rank2 == 4) {
            $p = new Primitive\Polygon();
            $p
                ->point(0, self::SIZE / 2)
                ->point(self::SIZE / 2 , self::SIZE / 2)
                ->point(self::SIZE / 2, 0)
                ->point(self::SIZE, 0)
                ->point(self::SIZE, self::SIZE / 2)
                ->point(self::SIZE / 2, self::SIZE)
                ->point(0, self::SIZE)
                ->color($this->fg());

            $this->add($p);
        }
        if ($rank2 == 5) {
            $this->row1(1);
            $this->row11(4);
            $this->last()->color($this->bg());
        }
        if ($rank2 == 6) {
            $p = new Primitive\Polygon();
            $p
                ->point(0, 0)
                ->point(self::SIZE / 2 , 0)
                ->point(self::SIZE / 2, self::SIZE / 2)
                ->point(self::SIZE, self::SIZE / 2)
                ->point(self::SIZE, self::SIZE)
                ->point(self::SIZE / 2, self::SIZE)
                ->point(0, self::SIZE / 2)
                ->color($this->fg());

            $this->add($p);
        }
        if ($rank2 == 7) {
            $this->row1(1);
            $this->row11(6);
            $this->last()->color($this->bg());
        }
        if ($rank2 == 8) {
            $p = new Primitive\Polygon();
            $p
                ->point(0, self::SIZE)
                ->point(self::SIZE / 4 , self::SIZE / 4)
                ->point(self::SIZE, 0)
                ->point(self::SIZE / 2, self::SIZE / 2)
                ->point(self::SIZE, self::SIZE)
                ->color($this->fg());

            $this->add($p);
        }
        if ($rank2 == 9) {
            $this->row1(1);
            $this->row11(8);
            $this->last()->color($this->bg());
        }
        if ($rank2 == 10) {
            $p = new Primitive\Polygon();
            $p
                ->point(0, 0)
                ->point(self::SIZE * (3/4) , self::SIZE / 4)
                ->point(self::SIZE, self::SIZE)
                ->point(self::SIZE / 2, self::SIZE / 2)
                ->point(0, self::SIZE)
                ->color($this->fg());

            $this->add($p);
        }
        if ($rank2 == 11) {
            $this->row1(1);
            $this->row11(10);
            $this->last()->color($this->bg());
        }
        if ($rank2 == 12) {
            $p = new Primitive\Polygon();
            $p
                ->point(0, 0)
                ->point(self::SIZE, 0)
                ->point(self::SIZE * (3/4), self::SIZE * (3/4))
                ->point(0, self::SIZE)
                ->point(self::SIZE / 2, self::SIZE / 2)
                ->color($this->fg());

            $this->add($p);
        }
        if ($rank2 == 13) {
            $this->row1(1);
            $this->row11(12);
            $this->last()->color($this->bg());
        }
        if ($rank2 == 14) {
            $p = new Primitive\Polygon();
            $p
                ->point(0, 0)
                ->point(self::SIZE / 2, self::SIZE / 2)
                ->point(self::SIZE, 0)
                ->point(self::SIZE, self::SIZE)
                ->point(self::SIZE / 4, self::SIZE * (3/4))
                ->color($this->fg());

            $this->add($p);
        }
        if ($rank2 == 15) {
            $this->row1(1);
            $this->row11(14);
            $this->last()->color($this->bg());
        }
    }

    public function row12($rank2)
    {
        if ($rank2 == 0) {
            $p = new Primitive\Polygon();
            $p
                ->point(0, 0)
                ->point(self::SIZE, self::SIZE / 2)
                ->point(0, self::SIZE)
                ->point(self::SIZE / 2, self::SIZE / 2)
                ->color($this->fg());

            $this->add($p);
        }
        if ($rank2 == 1) {
            $p = new Primitive\Polygon();
            $p
                ->point(0, 0)
                ->point(self::SIZE / 2, self::SIZE / 2)
                ->point(self::SIZE, 0)
                ->point(self::SIZE / 2, self::SIZE)
                ->color($this->fg());

            $this->add($p);
        }
        if ($rank2 == 2) {
            $p = new Primitive\Polygon();
            $p
                ->point(self::SIZE, 0)
                ->point(0, self::SIZE / 2)
                ->point(self::SIZE, self::SIZE)
                ->point(self::SIZE / 2, self::SIZE / 2)
                ->color($this->fg());

            $this->add($p);
        }
        if ($rank2 == 3) {
            $this->row1(1);
            $this->row12(0);
            $this->last()->color($this->bg());
        }
        if ($rank2 == 4) {
            $this->row1(1);
            $this->row12(1);
            $this->last()->color($this->bg());
        }
        if ($rank2 == 5) {
            $this->row1(1);
            $this->row12(2);
            $this->last()->color($this->bg());
        }
        if ($rank2 == 6) {
            $p = new Primitive\Polygon();
            $p
                ->point(self::SIZE / 2, 0)
                ->point(self::SIZE, 0)
                ->point(self::SIZE, self::SIZE /2)
                ->point(self::SIZE / 2, self::SIZE / 4)
                ->color($this->fg());

            $this->add($p);

            $p = new Primitive\Polygon();
            $p
                ->point(0, self::SIZE / 2)
                ->point(self::SIZE / 2, self::SIZE* (3/4))
                ->point(self::SIZE / 2, self::SIZE)
                ->point(0, self::SIZE)
                ->color($this->fg());

            $this->add($p);
        }
        if ($rank2 == 7) {
            $p = new Primitive\Polygon();
            $p
                ->point(0, 0)
                ->point(self::SIZE / 2, 0)
                ->point(self::SIZE / 4, self::SIZE / 2)
                ->point(0, self::SIZE / 2)
                ->color($this->fg());

            $this->add($p);

            $p = new Primitive\Polygon();
            $p
                ->point(self::SIZE * (3/4), self::SIZE / 2)
                ->point(self::SIZE, self::SIZE / 2)
                ->point(self::SIZE, self::SIZE)
                ->point(self::SIZE / 2, self::SIZE)
                ->color($this->fg());

            $this->add($p);
        }
        if ($rank2 == 8) {
            $p = new Primitive\Polygon();
            $p
                ->point(self::SIZE / 2, 0)
                ->point(self::SIZE, 0)
                ->point(self::SIZE, self::SIZE / 2)
                ->point(self::SIZE * (3/4), self::SIZE / 2)
                ->color($this->fg());

            $this->add($p);

            $p = new Primitive\Polygon();
            $p
                ->point(0, self::SIZE / 2)
                ->point(self::SIZE / 4, self::SIZE / 2)
                ->point(self::SIZE / 2, self::SIZE)
                ->point(0, self::SIZE)
                ->color($this->fg());

            $this->add($p);
        }
        if ($rank2 == 9) {
            $this->row1(1);
            $this->row12(6);
            $this->get(1)->color($this->bg());
            $this->get(2)->color($this->bg());
        }
        if ($rank2 == 10) {
            $this->row1(1);
            $this->row12(7);
            $this->get(1)->color($this->bg());
            $this->get(2)->color($this->bg());
        }
        if ($rank2 == 11) {
            $this->row1(1);
            $this->row12(8);
            $this->get(1)->color($this->bg());
            $this->get(2)->color($this->bg());
        }
        if ($rank2 == 12) {
            $p = new Primitive\Polygon();
            $p
                ->point(0, 0)
                ->point(self::SIZE / 2, self::SIZE / 2)
                ->point(self::SIZE / 4, self::SIZE * (3/4))
                ->point(0, self::SIZE / 2)
                ->color($this->fg());

            $this->add($p);

            $p = new Primitive\Polygon();
            $p
                ->point(self::SIZE / 2, self::SIZE / 2)
                ->point(self::SIZE * (3/4), self::SIZE / 4)
                ->point(self::SIZE, self::SIZE / 2)
                ->point(self::SIZE, self::SIZE)
                ->color($this->fg());

            $this->add($p);
        }
        if ($rank2 == 13) {
            $this->row1(1);
            $this->row12(12);
            $this->get(1)->color($this->bg());
            $this->get(2)->color($this->bg());
        }
        if ($rank2 == 14) {
            $this->row12(0);
            $this->row12(2);
        }
        if ($rank2 == 15) {
            $this->row12(3);
            $this->row12(2);
            $this->last()->color($this->bg());
        }
    }

    public function row13($rank2)
    {
        if ($rank2 == 0) {
            $d = new Primitive\Diamond();
            $d
                ->point(self::SIZE / 2, self::SIZE / 4)
                ->point(self::SIZE * (3/4), self::SIZE / 2)
                ->point(self::SIZE / 2, self::SIZE * (3/4))
                ->point(self::SIZE / 4, self::SIZE / 2)
                ->color($this->fg());

            $this->add($d);
        }
        if ($rank2 == 1) {
            $this->row1(1);
            $d = new Primitive\Diamond();
            $d
                ->point(self::SIZE / 2, self::SIZE / 4)
                ->point(self::SIZE * (3/4), self::SIZE / 2)
                ->point(self::SIZE / 2, self::SIZE * (3/4))
                ->point(self::SIZE / 4, self::SIZE / 2)
                ->color($this->bg());

            $this->add($d);
        }
        if ($rank2 == 2) {
            $this->row4(8);
            $d = new Primitive\Diamond();
            $d
                ->point(self::SIZE / 2, self::SIZE / 4)
                ->point(self::SIZE * (3/4), self::SIZE / 2)
                ->point(self::SIZE / 2, self::SIZE * (3/4))
                ->point(self::SIZE / 4, self::SIZE / 2)
                ->color($this->bg());

            $this->add($d);
        }
        if ($rank2 == 3) {
            $this->row4(9);
            $this->row13(0);
        }
        if ($rank2 == 4) {
            $this->row1(2);
            $this->row13(0);
        }
        if ($rank2 == 5) {
            $this->row1(3);
            $this->row13(0);
        }
        if ($rank2 == 6) {
            $this->row1(4);
            $this->row13(0);
        }
        if ($rank2 == 7) {
            $this->row1(5);
            $this->row13(0);
        }
        if ($rank2 == 8) {
            $this->row3(0);
            $this->row13(0);
        }
        if ($rank2 == 9) {
            $this->row3(1);
            $this->row13(0);
        }
        if ($rank2 == 10) {
            $this->row3(2);
            $this->row13(0);
        }
        if ($rank2 == 11) {
            $this->row3(3);
            $this->row13(0);
        }
        if ($rank2 == 12) {
            $this->row3(0);
            $this->row13(0);
            $this->last()->color($this->bg());
        }
        if ($rank2 == 13) {
            $this->row3(1);
            $this->row13(0);
            $this->last()->color($this->bg());
        }
        if ($rank2 == 14) {
            $this->row3(2);
            $this->row13(0);
            $this->last()->color($this->bg());
        }
        if ($rank2 == 15) {
            $this->row3(3);
            $this->row13(0);
            $this->last()->color($this->bg());
        }
    }

    public function row14($rank2)
    {
        if ($rank2 == 0) {
            $this->row2(0);
            $this->row4(10);
        }
        if ($rank2 == 1) {
            $this->row2(1);
            $this->row4(10);
        }
        if ($rank2 == 2) {
            $this->row2(2);
            $this->row4(10);
        }
        if ($rank2 == 3) {
            $this->row2(3);
            $this->row4(10);
        }
        if ($rank2 == 4) {
            $this->row13(12);
            $this->row6(3);
        }
        if ($rank2 == 5) {
            $this->row13(13);
            $this->row6(1);
        }
        if ($rank2 == 6) {
            $this->row13(14);
            $this->row6(2);
        }
        if ($rank2 == 7) {
            $this->row13(15);
            $this->row6(0);
        }
        if ($rank2 == 8) {
            $this->row8(12);
            $this->row12(0);
        }
        if ($rank2 == 9) {
            $this->row8(12);
            $this->row12(2);
        }
        if ($rank2 == 10) {
            $this->row8(11);
            $this->row12(1);
        }
        if ($rank2 == 11) {
            $this->row8(11);
            $this->row9(6);
        }
        if ($rank2 == 12) {
            $this->row2(0);
            $this->row4(12);
        }
        if ($rank2 == 13) {
            $this->row2(1);
            $this->row4(12);
        }
        if ($rank2 == 14) {
            $this->row2(2);
            $this->row4(12);
        }
        if ($rank2 == 15) {
            $this->row2(3);
            $this->row4(12);
        }
    }

    public function row15($rank2)
    {
        if ($rank2 == 0) {
            $t = new Primitive\Triangle();
            $t
                ->point(0, 0)
                ->point(self::SIZE / 2, 0)
                ->point(self::SIZE, self::SIZE)
                ->color($this->fg());

            $this->add($t);

            $t = new Primitive\Triangle();
            $t
                ->point(0, self::SIZE)
                ->point(self::SIZE, 0)
                ->point(self::SIZE / 2, self::SIZE)
                ->color($this->fg());

            $this->add($t);
        }
        if ($rank2 == 1) {
            $t = new Primitive\Triangle();
            $t
                ->point(self::SIZE, 0)
                ->point(self::SIZE / 2, 0)
                ->point(0, self::SIZE)
                ->color($this->fg());

            $this->add($t);

            $t = new Primitive\Triangle();
            $t
                ->point(self::SIZE, self::SIZE)
                ->point(0, 0)
                ->point(self::SIZE / 2, self::SIZE)
                ->color($this->fg());

            $this->add($t);
        }
        if ($rank2 == 2) {
            $t = new Primitive\Triangle();
            $t
                ->point(0, 0)
                ->point(self::SIZE, self::SIZE)
                ->point(0, self::SIZE / 2)
                ->color($this->fg());

            $this->add($t);

            $t = new Primitive\Triangle();
            $t
                ->point(self::SIZE, 0)
                ->point(self::SIZE, self::SIZE / 2)
                ->point(0, self::SIZE)
                ->color($this->fg());

            $this->add($t);
        }
        if ($rank2 == 3) {
            $this->row1(1);
            $this->row15(0);
            $this->get(1)->color($this->bg());
            $this->get(2)->color($this->bg());
        }
        if ($rank2 == 4) {
            $this->row1(1);
            $this->row15(1);
            $this->get(1)->color($this->bg());
            $this->get(2)->color($this->bg());
        }
        if ($rank2 == 5) {
            $this->row1(1);
            $this->row15(2);
            $this->get(1)->color($this->bg());
            $this->get(2)->color($this->bg());
        }
        if ($rank2 == 6) {
            $t = new Primitive\Triangle();
            $t
                ->point(0, 0)
                ->point(self::SIZE / 2, self::SIZE / 2)
                ->point(0, self::SIZE / 2)
                ->color($this->fg());

            $this->add($t);
            $t = new Primitive\Triangle();
            $t
                ->point(self::SIZE / 2, self::SIZE / 2)
                ->point(self::SIZE, self::SIZE)
                ->point(self::SIZE / 2, self::SIZE)
                ->color($this->fg());

            $this->add($t);
        }
        if ($rank2 == 7) {
            $t = new Primitive\Triangle();
            $t
                ->point(self::SIZE / 2, 0)
                ->point(self::SIZE, 0)
                ->point(self::SIZE / 2, self::SIZE / 2)
                ->color($this->fg());

            $this->add($t);
            $t = new Primitive\Triangle();
            $t
                ->point(0, self::SIZE / 2)
                ->point(self::SIZE / 2, self::SIZE / 2)
                ->point(0, self::SIZE)
                ->color($this->fg());

            $this->add($t);
        }
        if ($rank2 == 8) {
            $t = new Primitive\Triangle();
            $t
                ->point(0, 0)
                ->point(self::SIZE / 2, 0)
                ->point(self::SIZE / 2, self::SIZE / 2)
                ->color($this->fg());

            $this->add($t);
            $t = new Primitive\Triangle();
            $t
                ->point(self::SIZE / 2, self::SIZE / 2)
                ->point(self::SIZE, self::SIZE / 2)
                ->point(self::SIZE, self::SIZE)
                ->color($this->fg());

            $this->add($t);
        }
        if ($rank2 == 9) {
            $t = new Primitive\Triangle();
            $t
                ->point(0, self::SIZE)
                ->point(self::SIZE / 2, self::SIZE / 2)
                ->point(self::SIZE / 2, self::SIZE)
                ->color($this->fg());

            $this->add($t);
            $t = new Primitive\Triangle();
            $t
                ->point(self::SIZE / 2, self::SIZE / 2)
                ->point(self::SIZE, self::SIZE / 2)
                ->point(self::SIZE, 0)
                ->color($this->fg());

            $this->add($t);
        }
        if ($rank2 == 10) {
            $this->row1(1);
            $this->row15(6);
            $this->get(1)->color($this->bg());
            $this->get(2)->color($this->bg());
        }
        if ($rank2 == 11) {
            $this->row1(1);
            $this->row15(7);
            $this->get(1)->color($this->bg());
            $this->get(2)->color($this->bg());
        }
        if ($rank2 == 12) {
            $this->row1(1);
            $this->row15(8);
            $this->get(1)->color($this->bg());
            $this->get(2)->color($this->bg());
        }
        if ($rank2 == 13) {
            $this->row1(1);
            $this->row15(9);
            $this->get(1)->color($this->bg());
            $this->get(2)->color($this->bg());
        }
        if ($rank2 == 14) {
            $this->row8(11);
            $t = new Primitive\Triangle();
            $t
                ->point(0, 0)
                ->point(self::SIZE / 4, self::SIZE / 2)
                ->point(0, self::SIZE)
                ->color($this->fg());

            $this->add($t);
            $t = new Primitive\Triangle();
            $t
                ->point(self::SIZE, 0)
                ->point(self::SIZE * (3/4), self::SIZE / 2)
                ->point(self::SIZE, self::SIZE)
                ->color($this->fg());

            $this->add($t);
        }
        if ($rank2 == 15) {
            $this->row8(12);
            $t = new Primitive\Triangle();
            $t
                ->point(0, 0)
                ->point(self::SIZE, 0)
                ->point(self::SIZE / 2, self::SIZE / 4)
                ->color($this->fg());

            $this->add($t);
            $t = new Primitive\Triangle();
            $t
                ->point(0, self::SIZE)
                ->point(self::SIZE, self::SIZE)
                ->point(self::SIZE / 2, self::SIZE * (3/4))
                ->color($this->fg());

            $this->add($t);
        }
    }

    /**
     * Generates unit part by giving row index and column index to
     * choose the shapes to populate with.
     *
     * Parameters are both integers from 0 to 15 inclusive.
     *
     * @uses Unit::row0 Various shapes DONE
     * @uses Unit::row1 Square shapes DONE
     * @uses Unit::row2 Triangle shapes DONE
     * @uses Unit::row3 Rectangle shapes DONE
     * @uses Unit::row4 Circle shapes DONE
     * @uses Unit::row5 Polygon shapes DONE
     * @uses Unit::row6 Triangle shapes part 2 DONE
     * @uses Unit::row7 Circle shapes part 2 DONE
     * @uses Unit::row8 Diamond shapes 1 DONE
     * @uses Unit::row9 Polygon shapes part 2 DONE
     * @uses Unit::row10 Triangle shapes part 3 DONE
     * @uses Unit::row11 Polygon shapes part 3 DONE
     * @uses Unit::row12 Polygon shapes part 4 DONE
     * @uses Unit::row13 Mixed shapes part 1
     * @uses Unit::row14 Mixed shapes part 2
     * @uses Unit::row15 Mixed shapes part 3
     * @param  integer $rank1
     * @param  inteer  $rank2
     * @access public
     * @return Unit
     */
    public function generate($rank1, $rank2)
    {
        $str_method_name = 'row' . $rank1;
        if (method_exists($this,$str_method_name)) {
            $this->$str_method_name($rank2);
        } else {
            throw new \RuntimeException('Not implemented yet!');
        }

        return $this;
    }

    /**
     * SVG output
     *
     * Outputs the primitive groups as SVG code.
     *
     * @access public
     * @return string
     */
    public function svg()
    {
        $str_g = '';

        $bg = new Primitive\Square();
        $bg->point(0, 0)->size(self::SIZE);
        $bg->color($this->bg());

        $str_g .= $bg->svg();

        foreach ($this->arr_primitives as $p) {
            $str_g .= $p->svg();
        }

        return $str_g;
    }
}
