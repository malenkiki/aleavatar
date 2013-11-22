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


class Circle
{
    protected $arr_colors = array();
    protected $img = null;


    public function generate($int_type)
    {
        if($int_type == 0)
        {
        }

        return $this;
    }

    public function __destruct()
    {
        imagedestroy($img);
    }


    public function png()
    {
        $img = imagecreatetruecolor(32, 32);
        //$c1 = imagecolorallocate($img, 100, 10, 10);
        //$c2 = imagecolorallocate($img, 10, 10, 100);
        imagefill($img, 0, 0, $c1);
        imagefilledarc($img , 0, 0, 48 , 48 , 0 , 90 , $c2 , IMG_ARC_PIE );
        imagefilledarc($img , 0, 0, 32 , 32 , 0 , 90 , $c1 , IMG_ARC_PIE );
        imagepng($img, 'test.png');
    }

    public function svg()
    {
    }
}
