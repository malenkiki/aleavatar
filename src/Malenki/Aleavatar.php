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

date_default_timezone_set('UTC'); //put that into CLI script

/**
 * Generate random avatar(s) to populate your websites!
 */
class Aleavatar
{
    protected $arr_colors = array();
    protected $size = null;
    protected $image = null;

    public function __construct($width, $height)
    {
        $this->size = new \stdClass();
        $this->size->width = $width;
        $this->size->height = $height;
    }

    private function createColors()
    {
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
    }

    public function setColors(array $colors)
    {
        $this->arr_colors = $colors;
    }


    public function create()
    {
    }
}
