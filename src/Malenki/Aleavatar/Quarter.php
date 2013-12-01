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
 * Define a quarter part of the picture.
 *
 * A Quarter is define by 4 Units.
 *
 * @author Michel Petit <petit.michel@gmail.com> 
 * @license MIT
 */
class Quarter
{
    const TOP_LEFT = 0;
    const TOP_RIGHT = 1;
    const BOTTOM_RIGHT = 2;
    const BOTTOM_LEFT = 3;
    const SIZE = 64;
    
    protected $type = self::TOP_LEFT;
    protected $arr_units = array();
    protected $bool_rotate_way = true;


    public function __construct($type = self::TOP_LEFT, $bool_rotate_way)
    {
        $this->type = $type;
        $this->bool_rotate_way = $bool_rotate_way;
    }



    /**
     * Returns new quarter copied from current one and rotated for the top right corner. 
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
     * Returns new quarter copied from current one and rotated for the bottom right corner. 
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
     * Returns new quarter copied from current one and rotated for the bottom left corner. 
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
     * Set all unit parts of the current quarter using an array.
     * 
     * @param array $arr 
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
     * @param Unit $unit 
     * @access public
     * @return void
     */
    public function add($unit)
    {
        $this->arr_units[] = $unit;
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
        
        $this->arr_units[0]->bg()->gd($img);
        $this->arr_units[0]->fg()->gd($img);
        
        foreach($this->arr_units as $k => $u)
        {
            $img_u = $u->png();
            
            $dst_x = 0;
            $dst_y = 0;

            if($k == 1)
            {
                $dst_x = Unit::SIZE;
                $dst_y = 0;
            }
            if($k == 2)
            {
                $dst_x = Unit::SIZE;
                $dst_y = Unit::SIZE;
            }
            if($k == 3)
            {
                $dst_x = 0;
                $dst_y = Unit::SIZE;
            }
            imagecopy($img, $img_u, $dst_x, $dst_y, 0, 0, Unit::SIZE, Unit::SIZE);
            imagedestroy($img_u);
        }

        if($this->type != self::TOP_LEFT)
        {
            $int_way = $this->bool_rotate_way ? 1 : -1;
            $img2 =  imagerotate($img, $this->type * 90 * $int_way, 0);
            imagedestroy($img);
            return $img2;
        }
        else
        {
            return $img;
        }
    }



    public function svg()
    {
        $str_g = '';
        
        foreach($this->arr_units as $k => $u)
        {
            $int_dx = 0;
            $int_dy = 0;

            if($k == self::TOP_RIGHT)
            {
                $int_dx = Unit::SIZE;
            }
            elseif($k == self::BOTTOM_RIGHT)
            {
                $int_dx = Unit::SIZE;
                $int_dy = Unit::SIZE;
            }
            elseif($k == self::BOTTOM_LEFT)
            {
                $int_dy = Unit::SIZE;
            }

            $str_attr_translate = sprintf(
                ' transform="translate(%d, %d)"',
                $int_dx,
                $int_dy
            );

            if($int_dx || $int_dy)
            {
                $str_g .= sprintf('<g%s>%s</g>', $str_attr_translate, $u->svg()) . "\n";
            }
            else
            {
                $str_g .= $u->svg() . "\n";
            }
        }

        $str_attr = '';

        if($this->type != self::TOP_LEFT)
        {
            $int_dx = 0;
            $int_dy = 0;

            if($this->type == self::TOP_RIGHT)
            {
                $int_dx = self::SIZE;
            }
            elseif($this->type == self::BOTTOM_RIGHT)
            {
                $int_dx = self::SIZE;
                $int_dy = self::SIZE;
            }
            elseif($this->type == self::BOTTOM_LEFT)
            {
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
