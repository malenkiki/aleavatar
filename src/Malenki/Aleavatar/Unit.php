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
 * @copyright 2013 Michel Petit
 * @author Michel Petit <petit.michel@gmail.com> 
 * @license MIT
 */
class Unit
{
    const SIZE = 32;
    
    protected $arr_colors = array();
    protected $arr_primitives = array();


    protected function add($p)
    {
        $this->arr_primitives[] = $p;
    }

    public function bg()
    {
        return $this->arr_colors[0];
    }

    public function fg()
    {
        return $this->arr_colors[1];
    }



    public function __construct($id)
    {
        $this->id = $id;
    }



    public function background(\Malenki\Aleavatar\Primitive\Color $color)
    {
        $this->arr_colors[0] = $color;
    }



    public function foreground(\Malenki\Aleavatar\Primitive\Color $color)
    {
        $this->arr_colors[1] = $color;
    }


    
    /**
     * Shapes with arcs 
     *
     * @todo Create true Arc primitive!
     * @param integer $rank2 
     * @access protected
     * @return void
     */
    protected function row0($rank2)
    {
        /*
        // Mid sizes arc TL
        if($rank2 == 0)
        {
            $el = new Primitive\Ellipse();
            $el->point(0, 0);
            $el->radius(self::SIZE / 2);
            $el->color($this->fg());
            $this->add($el);
        }
        // Mid sizes arc TR
        if($rank2 == 1)
        {
            $el = new Primitive\Ellipse();
            $el->point(self::SIZE, 0);
            $el->radius(self::SIZE / 2);
            $el->color($this->fg());
            $this->add($el);
        }
        // Mid sizes arc BR
        if($rank2 == 2)
        {
            $el = new Primitive\Ellipse();
            $el->point(self::SIZE, self::SIZE);
            $el->radius(self::SIZE / 2);
            $el->color($this->fg());
            $this->add($el);
        }
        // Mid sizes arc BL
        if($rank2 == 3)
        {
            $el = new Primitive\Ellipse();
            $el->point(0, self::SIZE);
            $el->radius(self::SIZE / 2);
            $el->color($this->fg());
            $this->add($el);
        }
        // Big arc TL
        if($rank2 == 4)
        {
            $el = new Primitive\Ellipse();
            $el->point(0, 0);
            $el->radius(self::SIZE);
            $el->color($this->fg());
            $this->add($el);
        }
        // Big arc TR
        if($rank2 == 5)
        {
            $el = new Primitive\Ellipse();
            $el->point(self::SIZE, 0);
            $el->radius(self::SIZE);
            $el->color($this->fg());
            $this->add($el);
        }
        // Big arc BR
        if($rank2 == 6)
        {
            $el = new Primitive\Ellipse();
            $el->point(self::SIZE, self::SIZE);
            $el->radius(self::SIZE);
            $el->color($this->fg());
            $this->add($el);
        }
        // Big arc BL
        if($rank2 == 7)
        {
            $el = new Primitive\Ellipse();
            $el->point(0, self::SIZE);
            $el->radius(self::SIZE);
            $el->color($this->fg());
            $this->add($el);
        }

        // compound mid-sized arc and big size arc TL
        if($rank2 == 8)
        {
            $el = new Primitive\Ellipse();
            $el->point(0, 0);
            $el->radius(self::SIZE);
            $el->color($this->fg());
            $this->add($el);
            $el = new Primitive\Ellipse();
            $el->point(0, 0);
            $el->radius(self::SIZE / 2);
            $el->color($this->bg());
            $this->add($el);
        }
        // compound mid-sized arc and big size arc TR
        if($rank2 == 9)
        {
            $el = new Primitive\Ellipse();
            $el->point(self::SIZE, 0);
            $el->radius(self::SIZE);
            $el->color($this->fg());
            $this->add($el);
            $el = new Primitive\Ellipse();
            $el->point(self::SIZE, 0);
            $el->radius(self::SIZE / 2);
            $el->color($this->bg());
            $this->add($el);
        }
        // compound mid-sized arc and big size arc BR
        if($rank2 == 10)
        {
            $el = new Primitive\Ellipse();
            $el->point(self::SIZE, self::SIZE);
            $el->radius(self::SIZE);
            $el->color($this->fg());
            $this->add($el);
            $el = new Primitive\Ellipse();
            $el->point(self::SIZE, self::SIZE);
            $el->radius(self::SIZE / 2);
            $el->color($this->bg());
            $this->add($el);
        }
        // compound mid-sized arc and big size arc BL
        if($rank2 == 11)
        {
            $el = new Primitive\Ellipse();
            $el->point(0, self::SIZE);
            $el->radius(self::SIZE);
            $el->color($this->fg());
            $this->add($el);
            $el = new Primitive\Ellipse();
            $el->point(0, self::SIZE);
            $el->radius(self::SIZE / 2);
            $el->color($this->bg());
            $this->add($el);
        }
         */
    }



    /**
     * Shapes with squares.
     * 
     * @param inteer $rank2 
     * @access protected
     * @return void
     */
    protected function row1($rank2)
    {
        // As void, so, square take all place and take background color.
        if($rank2 == 0)
        {
            $c = new Primitive\Square();
            $c->point(0, 0)->size(Unit::SIZE)->color($this->bg());
            $this->add($c);
        }
        // As plain square
        if($rank2 == 1)
        {
            $c = new Primitive\Square();
            $c->point(0, 0)->size(Unit::SIZE)->color($this->fg());
            $this->add($c);
        }
        // Mid sized suare TL
        if($rank2 == 2)
        {
            $c = new Primitive\Square();
            $c->point(0, 0);
            $c->size(Unit::SIZE / 2);
            $c->color($this->fg());
            $this->add($c);
        }
        // Mid sized suare TR
        if($rank2 == 3)
        {
            $c = new Primitive\Square();
            $c->point(Unit::SIZE / 2, 0);
            $c->size(Unit::SIZE / 2);
            $c->color($this->fg());
            $this->add($c);
        }
        // Mid sized suare BR
        if($rank2 == 4)
        {
            $c = new Primitive\Square();
            $c->point(Unit::SIZE / 2, Unit::SIZE / 2);
            $c->size(Unit::SIZE / 2);
            $c->color($this->fg());
            $this->add($c);
        }
        // Mid sized suare BL
        if($rank2 == 5)
        {
            $c = new Primitive\Square();
            $c->point(0, Unit::SIZE / 2);
            $c->size(Unit::SIZE / 2);
            $c->color($this->fg());
            $this->add($c);
        }
        // Mid sized squares TL + BR
        if($rank2 == 6)
        {
            $this->row0(2);
            $this->row0(4);
        }
        // Mid sized squares TR + BL
        if($rank2 == 7)
        {
            $this->row0(3);
            $this->row0(5);
        }
        // Little small square diagonal TL BR
        if($rank2 == 8)
        {
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
            $c->point((int)((3 / 4) * Unit::SIZE), (int)((3 / 4) * Unit::SIZE));
            $c->size(Unit::SIZE / 4);
            $c->color($this->fg());
            $this->add($c);
        }
        // Little small square diagonal BL TR
        if($rank2 == 9)
        {
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
        if($rank2 == 10)
        {
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
            $c->point((int)((3 / 4) * Unit::SIZE), (int)((3 / 4) * Unit::SIZE));
            $c->size(Unit::SIZE / 4);
            $c->color($this->bg());
            $this->add($c);
        }
        // same as 9 but in reversed colors
        if($rank2 == 11)
        {
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
        if($rank2 == 12)
        {
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
        if($rank2 == 13)
        {
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
        if($rank2 == 14)
        {
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
        if($rank2 == 15)
        {
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
     * Shapes with triangles.
     * 
     * @param inteer $rank2 
     * @access protected
     * @return void
     */
    protected function row2($rank2)
    {
        // Big triangle TL
        if($rank2 == 0)
        {
            $c = new Primitive\Triangle();
            $c->point(0, 0);
            $c->point(Unit::SIZE, 0);
            $c->point(0, Unit::SIZE);
            $c->color($this->fg());
            $this->add($c);
        }
        // Big triangle TR
        if($rank2 == 1)
        {
            $c = new Primitive\Triangle();
            $c->point(Unit::SIZE, 0);
            $c->point(Unit::SIZE, Unit::SIZE);
            $c->point(0, 0);
            $c->color($this->fg());
            $this->add($c);
        }
        // Big triangle BR
        if($rank2 == 2)
        {
            $c = new Primitive\Triangle();
            $c->point(Unit::SIZE, 0);
            $c->point(Unit::SIZE, Unit::SIZE);
            $c->point(0, Unit::SIZE);
            $c->color($this->fg());
            $this->add($c);
        }
        // Big triangle BL
        if($rank2 == 3)
        {
            $c = new Primitive\Triangle();
            $c->point(0, 0);
            $c->point(Unit::SIZE, Unit::SIZE);
            $c->point(0, Unit::SIZE);
            $c->color($this->fg());
            $this->add($c);
        }

        // triangle TL
        if($rank2 == 4)
        {
            $c = new Primitive\Triangle();
            $c->point(0, 0);
            $c->point(Unit::SIZE / 2, 0);
            $c->point(0, Unit::SIZE / 2);
            $c->color($this->fg());
            $this->add($c);
        }
        // triangle TR
        if($rank2 == 5)
        {
            $c = new Primitive\Triangle();
            $c->point(Unit::SIZE / 2, 0);
            $c->point(Unit::SIZE, Unit::SIZE / 2);
            $c->point(Unit::SIZE, 0);
            $c->color($this->fg());
            $this->add($c);
        }
        // triangle BR
        if($rank2 == 6)
        {
            $c = new Primitive\Triangle();
            $c->point(Unit::SIZE, Unit::SIZE / 2);
            $c->point(Unit::SIZE, Unit::SIZE);
            $c->point(Unit::SIZE / 2, Unit::SIZE);
            $c->color($this->fg());
            $this->add($c);
        }
        // triangle BL
        if($rank2 == 7)
        {
            $c = new Primitive\Triangle();
            $c->point(0, Unit::SIZE / 2);
            $c->point(Unit::SIZE / 2, Unit::SIZE);
            $c->point(0, Unit::SIZE);
            $c->color($this->fg());
            $this->add($c);
        }


        // 2  triangles TL BR
        if($rank2 == 8)
        {
            $this->row2(4);
            $this->row2(6);
        }
        // 2  triangles TR BL
        if($rank2 == 9)
        {
            $this->row2(5);
            $this->row2(7);
        }
        
        // 2  triangles TL TR
        if($rank2 == 10)
        {
            $this->row2(4);
            $this->row2(5);
        }
        // 2  triangles BL BR
        if($rank2 == 11)
        {
            $this->row2(6);
            $this->row2(7);
        }
        
        // 2  triangles TL BL
        if($rank2 == 12)
        {
            $this->row2(4);
            $this->row2(7);
        }
        // 2  triangles TR BR
        if($rank2 == 13)
        {
            $this->row2(5);
            $this->row2(6);
        }
        // 2 triangles CENTER TOP and BOTTOM
        if($rank2 == 14)
        {
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
        if($rank2 == 15)
        {
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


    public function row3($rank2)
    {
        // Big rectangle TOP
        if($rank2 == 0)
        {
            $c = new Primitive\Rectangle();
            $c->point(0, 0);
            $c->size(Unit::SIZE, Unit::SIZE / 2);
            $c->color($this->fg());
            $this->add($c);
        }
        // Big rectangle BOTTOM
        if($rank2 == 1)
        {
            $c = new Primitive\Rectangle();
            $c->point(0, Unit::SIZE / 2);
            $c->size(Unit::SIZE, Unit::SIZE / 2);
            $c->color($this->fg());
            $this->add($c);
        }
        // Big rectangle LEFT
        if($rank2 == 2)
        {
            $c = new Primitive\Rectangle();
            $c->point(0, 0);
            $c->size(Unit::SIZE / 2, Unit::SIZE);
            $c->color($this->fg());
            $this->add($c);
        }
        // Big rectangle RIGHT
        if($rank2 == 3)
        {
            $c = new Primitive\Rectangle();
            $c->point(Unit::SIZE / 2, 0);
            $c->size(Unit::SIZE / 2, Unit::SIZE);
            $c->color($this->fg());
            $this->add($c);
        }
        // Big rectangle MIDDLE
        if($rank2 == 4)
        {
            $c = new Primitive\Rectangle();
            $c->point(0, Unit::SIZE / 4);
            $c->size(Unit::SIZE, Unit::SIZE / 2);
            $c->color($this->fg());
            $this->add($c);
        }
        // Big rectangle MIDDLE HORIZONTALY
        if($rank2 == 5)
        {
            $c = new Primitive\Rectangle();
            $c->point(Unit::SIZE / 4, 0);
            $c->size(Unit::SIZE / 2, Unit::SIZE);
            $c->color($this->fg());
            $this->add($c);
        }
        // Long rectangle DIAGONAL BL TR
        if($rank2 == 6)
        {
            $c = new Primitive\Polygon();
            $c->point((int) (Unit::SIZE * (3/4)), 0);
            $c->point(Unit::SIZE, (int) (Unit::SIZE * (1/4)));
            $c->point((int)(Unit::SIZE * (1/4)), Unit::SIZE);
            $c->point(0, (int)(Unit::SIZE * (3/4)));
            $c->color($this->fg());
            $this->add($c);
        }
        // Long rectangle DIAGONAL TL BR
        if($rank2 == 7)
        {
            $c = new Primitive\Polygon();
            $c->point((int) (Unit::SIZE * (1/4)), 0);
            $c->point(Unit::SIZE, (int) (Unit::SIZE * (3/4)));
            $c->point((int)(Unit::SIZE * (3/4)), Unit::SIZE);
            $c->point(0, (int)(Unit::SIZE * (1/4)));
            $c->color($this->fg());
            $this->add($c);
        }
        // Long rectangle TOP
        if($rank2 == 8)
        {
            $c = new Primitive\Rectangle();
            $c->point(0, 0);
            $c->size(Unit::SIZE, Unit::SIZE / 4);
            $c->color($this->fg());
            $this->add($c);
        }
        // Long rectangle BOTTOM
        if($rank2 == 9)
        {
            $c = new Primitive\Rectangle();
            $c->point(0, Unit::SIZE * (3/4));
            $c->size(Unit::SIZE, Unit::SIZE / 4);
            $c->color($this->fg());
            $this->add($c);
        }
        // Long rectangle LEFT
        if($rank2 == 10)
        {
            $c = new Primitive\Rectangle();
            $c->point(0, 0);
            $c->size(Unit::SIZE / 4, Unit::SIZE);
            $c->color($this->fg());
            $this->add($c);
        }
        // Long rectangle RIGHT
        if($rank2 == 11)
        {
            $c = new Primitive\Rectangle();
            $c->point(Unit::SIZE * (3/4), 0);
            $c->size(Unit::SIZE / 4, Unit::SIZE);
            $c->color($this->fg());
            $this->add($c);
        }
        // 2 Long rectangles TOP and BOTTOM
        if($rank2 == 12)
        {
            $this->row3(8);
            $this->row3(9);
        }

        // 2 long rectangles LEFT and RIGHT
        if($rank2 == 13)
        {
            $this->row3(10);
            $this->row3(11);
        }
        // small TL
        if($rank2 == 14)
        {
            $c = new Primitive\Rectangle();
            $c->point(0, 0)->size(Unit::SIZE / 2, Unit::SIZE / 4);
            $c->color($this->fg());
            $this->add($c);
        }
        // small BR
        if($rank2 == 15)
        {
            $c = new Primitive\Rectangle();
            $c->point(Unit::SIZE / 2, Unit::SIZE * (3/4));
            $c->size(Unit::SIZE / 2, Unit::SIZE / 4);
            $c->color($this->fg());
            $this->add($c);
        }
    }
    
    
    /**
     * Shapes with circles 
     *
     * @param integer $rank2 
     * @access protected
     * @return void
     */
    protected function row4($rank2)
    {
        // Mid sizes TL
        if($rank2 == 0)
        {
            $el = new Primitive\Ellipse(self::SIZE / 4, self::SIZE / 4);
            $el->radius(self::SIZE / 4);
            $el->color($this->fg());
            $this->add($el);
        }
        // Mid sizes TR
        if($rank2 == 1)
        {
            $el = new Primitive\Ellipse(self::SIZE * (3/4), self::SIZE / 4);
            $el->radius(self::SIZE / 4);
            $el->color($this->fg());
            $this->add($el);
        }
        // Mid sizes BR
        if($rank2 == 2)
        {
            $el = new Primitive\Ellipse(self::SIZE * (3/4), self::SIZE * (3/4));
            $el->radius(self::SIZE / 4);
            $el->color($this->fg());
            $this->add($el);
        }
        // Mid sizes BL
        if($rank2 == 3)
        {
            $el = new Primitive\Ellipse(self::SIZE / 4, self::SIZE * (3/4));
            $el->radius(self::SIZE / 4);
            $el->color($this->fg());
            $this->add($el);
        }
        if($rank2 == 4)
        {
            $el = new Primitive\Ellipse(self::SIZE / 4, self::SIZE / 4);
            $el->radius(self::SIZE / 4);
            $el->color($this->fg());
            $this->add($el);
            $el = new Primitive\Ellipse(self::SIZE / 4, self::SIZE / 4);
            $el->radius(self::SIZE / 8);
            $el->color($this->bg());
            $this->add($el);
        }
        if($rank2 == 5)
        {
            $el = new Primitive\Ellipse(self::SIZE * (3/4), self::SIZE / 4);
            $el->radius(self::SIZE / 4);
            $el->color($this->fg());
            $this->add($el);
            $el = new Primitive\Ellipse(self::SIZE * (3/4), self::SIZE / 4);
            $el->radius(self::SIZE / 8);
            $el->color($this->bg());
            $this->add($el);
        }
        if($rank2 == 6)
        {
            $el = new Primitive\Ellipse(self::SIZE * (3/4), self::SIZE * (3/4));
            $el->radius(self::SIZE / 4);
            $el->color($this->fg());
            $this->add($el);
            $el = new Primitive\Ellipse(self::SIZE * (3/4), self::SIZE * (3/4));
            $el->radius(self::SIZE / 8);
            $el->color($this->bg());
            $this->add($el);
        }
        if($rank2 == 7)
        {
            $el = new Primitive\Ellipse(self::SIZE / 4, self::SIZE * (3/4));
            $el->radius(self::SIZE / 4);
            $el->color($this->fg());
            $this->add($el);
            $el = new Primitive\Ellipse(self::SIZE / 4, self::SIZE * (3/4));
            $el->radius(self::SIZE / 8);
            $el->color($this->bg());
            $this->add($el);
        }
        if($rank2 == 8)
        {
            $el = new Primitive\Ellipse(self::SIZE / 2, self::SIZE / 2);
            $el->radius(self::SIZE / 2);
            $el->color($this->fg());
            $this->add($el);
        }
        if($rank2 == 9)
        {
            $this->row0(1);
            $el = new Primitive\Ellipse(self::SIZE / 2, self::SIZE / 2);
            $el->radius(self::SIZE / 2);
            $el->color($this->bg());
            $this->add($el);
        }
        if($rank2 == 10)
        {
            $this->row4(8);
            $el = new Primitive\Ellipse(self::SIZE / 2, self::SIZE / 2);
            $el->radius(self::SIZE / 4);
            $el->color($this->bg());
            $this->add($el);
        }
        if($rank2 == 11)
        {
            $this->row4(9);
            $el = new Primitive\Ellipse(self::SIZE / 2, self::SIZE / 2);
            $el->radius(self::SIZE / 4);
            $el->color($this->fg());
            $this->add($el);
        }
        if($rank2 == 12)
        {
            $this->row4(10);
            $el = new Primitive\Ellipse(self::SIZE / 2, self::SIZE / 2);
            $el->radius(self::SIZE / 8);
            $el->color($this->fg());
            $this->add($el);
        }
        if($rank2 == 13)
        {
            $this->row4(11);
            $el = new Primitive\Ellipse(self::SIZE / 2, self::SIZE / 2);
            $el->radius(self::SIZE / 8);
            $el->color($this->bg());
            $this->add($el);
        }
        if($rank2 == 14)
        {
            $this->row4(0);
            $this->row4(2);
        }
        if($rank2 == 15)
        {
            $this->row4(1);
            $this->row4(3);
        }

    }


    public function row5($rank2)
    {
        // "squared" arrow TL
        if($rank2 == 0)
        {
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
        if($rank2 == 1)
        {
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
        if($rank2 == 2)
        {
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
        if($rank2 == 3)
        {
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
        if($rank2 == 4)
        {
        }
        if($rank2 == 5)
        {
        }
        if($rank2 == 6)
        {
        }
        if($rank2 == 7)
        {
        }
        if($rank2 == 8)
        {
        }
        if($rank2 == 9)
        {
        }
        if($rank2 == 10)
        {
        }
        if($rank2 == 11)
        {
        }
        if($rank2 == 12)
        {
        }
        if($rank2 == 13)
        {
        }
        if($rank2 == 14)
        {
        }
        if($rank2 == 15)
        {
        }
    }



    /**
     * Generates unit part by giving $rank1 and $rank2 to 
     * choose the shapes to populate with. 
     * 
     * Parameters are both integers from 0 to 15 inclusive.
     *
     * @uses Unit::row0 Square shapes DONE
     * @uses Unit::row1 Arc shapes
     * @uses Unit::row2 Triangle shapes DONE
     * @uses Unit::row3 Rectangle shapes DONE
     * @uses Unit::row4 Circle shapes DONE
     * @uses Unit::row5 Polygon shapes
     * @uses Unit::row6 Triangle shapes part 2
     * @uses Unit::row7 Circle shapes part 2
     * @uses Unit::row8 Polygon shapes part 2
     * @uses Unit::row9 Square shapes part 2
     * @uses Unit::row10 Mixed shapes part 1
     * @uses Unit::row11 Mixed shapes part 2
     * @uses Unit::row12 Mixed shapes part 3
     * @uses Unit::row13 Mixed shapes part 4
     * @uses Unit::row14 Mixed shapes part 5
     * @uses Unit::row15 Mixed shapes part 6
     * @param integer $rank1
     * @param inteer $rank2 
     * @access public
     * @return Unit
     */
    public function generate($rank1, $rank2)
    {
        $str_method_name = 'row' . $rank1;
        $this->$str_method_name($rank2);

        return $this;
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

        $this->bg()->gd($img);
        $this->fg()->gd($img);
        
        imagefill($img, 0, 0, $this->bg()->gd($img));
        
        foreach($this->arr_primitives as $p)
        {
            $p->png($img);
        }

        //imagepng($img, 'test.png');//DEBUG
        return $img;
    }

    public function svg()
    {
        $str_g = '';
        
        $bg = new Primitive\Square();
        $bg->point(0, 0)->size(self::SIZE);
        $bg->color($this->bg());

        $str_g .= $bg->svg();

        foreach($this->arr_primitives as $p)
        {
            $str_g .= $p->svg();
        }

        return $str_g;
    }
}
