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
namespace Malenki;

if(!extension_loaded('gd'))
{
    throw new \RuntimeException('GD is not available! Aleavatar uses GD to work!');
}


/**
 * Generate random avatar(s) to populate your websites!
 */
class Aleavatar
{
    const TYPE_SQUARES = 'squares';
    const TYPE_DISCS = 'discs';
    const TYPE_RANDOM_SHAPES = 'randomShapes';

    protected $arr_colors = array();
    protected $int_amount_colors = 0;
    protected $size = null;
    protected $image = null;

    public function __construct($width, $height)
    {
        $this->size = new \stdClass();
        $this->size->width = $width;
        $this->size->height = $height;

        $this->image = imagecreatetruecolor(12, 12);

        $this->createColors();
    }



    protected function diagonalSquares($int_way)
    {
        //TODO
        printf("Diagonal squares selected way %d.\n", $int_way);
    }



    protected function squaresInsideSquares($int_amount)
    {
        //TODO
        printf("Squares inside squares selected way with %d squares to generate.\n", $int_amount);
    }



    protected function areaSquares()
    {
        //TODO
        printf("Area squares selected.\n", $int_way);
    }



    protected function squares()
    {
        // Diagonals (1) or squares inside squares (2) or area (3)?
        $int_choice = rand(1,3);

        // Diagonal squares choices…
        if($int_choice == 1)
        {
            // 1 or 2 diagonals?
            $int_amount = rand(1, 2);

            // If only one, what way to choose?
            if($int_amount == 1)
            {
                $int_way = rand(1, 2);
                $this->diagonalSquares($int_way);
            }
            else
            {
                $this->diagonalSquares(1);
                $this->diagonalSquares(2);
            }
        }
        elseif($int_choice == 2)
        {
            $int_amount = rand(2, 5);
            $this->squaresInsideSquares($int_amount);
        }
        else
        {
            $this->areaSquares();
        }
    }



    protected function discs()
    {
        //TODO
    }



    protected function createColors()
    {
        date_default_timezone_set('UTC'); //TODO: put that into CLI script

        $str_32 = md5(date('YmdHis') . rand() . sqrt(rand(0, 9)));
        $str_32_rev = strrev($str_32);
        $str_32_rand1 = str_shuffle($str_32);
        $str_32_rand2 = str_shuffle($str_32_rev);

        foreach(array($str_32, $str_32_rev, $str_32_rand1, $str_32_rand2) as $str)
        {
            $arr_sub_1 = str_split($str, 6);
            $arr_sub_2 = str_split(substr($str, 2), 6);
            $arr_sub_3 = str_split(substr($str, 1, 30), 6);
            $arr = array(array_pop($arr_sub_1), substr($str,0, 2), $str[0] . $str[31]);
            $arr_sub_4 = array(
                join($arr),
                $arr[0].$arr[2].$arr[1],
                $arr[1].$arr[2].$arr[0],
                $arr[1].$arr[0].$arr[2],
                $arr[2].$arr[1].$arr[0],
                $arr[2].$arr[0].$arr[1]
            );
            $this->arr_colors = array_unique(array_merge($this->arr_colors, $arr_sub_1, $arr_sub_2, $arr_sub_3, $arr_sub_4));
        }

        $this->int_amount_colors = count($this->arr_colors);
    }



    public function amountOfColors($int_amount = 16)
    {
        if($int_amount < 2)
        {
            throw new \InvalidArgumentException('Minimal numbers of colors cannot be less than 2!');
        }

        if($int_amount <= count($this->arr_colors))
        {
            $this->int_amount_colors = $int_amount;
        }

        return $this;
    }



    public function create($str_type = self::TYPE_SQUARES)
    {
        if(
            !in_array(
                $str_type,
                array(
                    self::TYPE_SQUARES,
                    self::TYPE_DISCS,
                    self::TYPE_RANDOM_SHAPES
                )
            )
        )
        {
            throw new \InvalidArgumentException('Invalid type of generator given!');
        }

        $this->$str_type();
    }
    
    
    
    public function __destruct ()
    {
        imagedestroy($this->image);
        $this->image = null;
    }

}
