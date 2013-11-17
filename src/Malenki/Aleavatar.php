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
    protected $arr_selected_colors = array();
    protected $int_current_color = 0;

    protected $size = null;
    
    protected $image = null;

    public function __construct($width, $height, $colors = 16)
    {
        $this->size = new \stdClass();
        $this->size->width = $width;
        $this->size->height = $height;

        $this->image = imagecreatetruecolor(12, 12);

        $this->createColors();
        $this->amountOfColors($colors);
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
        $image = imagecreatetruecolor(6, 6);
        imagefill($image, 0, 0, $this->getColor($image));
        /*
        
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
        */

        return $image;
    }



    protected function discs()
    {
        //TODO
        $image = imagecreatetruecolor(6, 6);
        return $image;
    }



    protected function randomShapes()
    {
        // TODO
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



    protected function amountOfColors($int_amount = 16)
    {
        if($int_amount < 2)
        {
            throw new \InvalidArgumentException('Minimal numbers of colors cannot be less than 2!');
        }

        if($int_amount <= count($this->arr_colors))
        {
            $this->int_amount_colors = $int_amount;
        }

        $arr = array_rand($this->arr_colors, $this->int_amount_colors);

        foreach($arr as $idx)
        {
            $this->arr_selected_colors[] = $this->arr_colors[$idx];
        }

        return $this;
    }



    protected function getColor($image)
    {
        $str_current = $this->arr_selected_colors[$this->int_current_color];

        $this->int_current_color++;

        if($this->int_current_color >= $this->int_amount_colors)
        {
            $this->int_current_color = 0;
        }

        list($str_red, $str_green, $str_blue) = str_split($str_current, 2);

        $int_red = hexdec($str_red);
        $int_green = hexdec($str_green);
        $int_blue = hexdec($str_blue);
        
        return imagecolorallocate($image, $int_red, $int_green, $int_blue);
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

        if($str_type == self::TYPE_SQUARES || $str_type == self::TYPE_DISCS)
        {
            if(rand(1, 2) == 1)
            {
                //TODO repeat for 3 other quadrants by symetry
                $img = $this->$str_type();
                // imageflip only for php 5.5! need special method to do that if php version < 5.5!!!
                //$img2 = imageflip($img,);
                imagecopy($this->image, $img, 0, 0, 0, 0, 6, 6);
                imagecopy($this->image, $img, 6, 0, 0, 0, 6, 6);
                imagecopy($this->image, $img, 6, 6, 0, 0, 6, 6);
                imagecopy($this->image, $img, 0, 6, 0, 0, 6, 6);
                imagedestroy($img);
            }
            else
            {
                $img = $this->$str_type();
                imagecopy($this->image, $img, 0, 0, 0, 0, 6, 6);
                imagedestroy($img);
                $img = $this->$str_type();
                imagecopy($this->image, $img, 6, 0, 0, 0, 6, 6);
                imagedestroy($img);
                $img = $this->$str_type();
                imagecopy($this->image, $img, 6, 6, 0, 0, 6, 6);
                imagedestroy($img);
                $img = $this->$str_type();
                imagecopy($this->image, $img, 0, 6, 0, 0, 6, 6);
                imagedestroy($img);
            }
        }
        else
        {
            $img = $this->$str_type();
            imagecopy($this->image, $img, 0, 0, 0, 0, 6, 6);
            imagedestroy($img);
            $img = $this->$str_type();
            imagecopy($this->image, $img, 6, 0, 0, 0, 6, 6);
            imagedestroy($img);
            $img = $this->$str_type();
            imagecopy($this->image, $img, 6, 6, 0, 0, 6, 6);
            imagedestroy($img);
            $img = $this->$str_type();
            imagecopy($this->image, $img, 0, 6, 0, 0, 6, 6);
            imagedestroy($img);
        }

        return $this;
    }
    


    public function save($str_filename)
    {
        imagepng($this->image, $str_filename.'.png');
    }



    public function display()
    {
        header('Content-Type: image/png');
        imagepng($this->image);
    }
    
    
    public function __destruct ()
    {
        imagedestroy($this->image);
        $this->image = null;
    }

}
