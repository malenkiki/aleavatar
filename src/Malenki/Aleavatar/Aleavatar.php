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



if(!extension_loaded('gd'))
{
    throw new \RuntimeException('GD is not available! Aleavatar uses GD to work!');
}



/**
 * Generate random avatar(s) to populate your websites!
 *
 * @property-read string $seed Seed used to create avatar
 * @property-read string $hash Hash of the seed
 * @copyright 2013 Michel Petit
 * @author Michel Petit <petit.michel@gmail.com> 
 * @license MIT
 */
class Aleavatar
{
    protected $arr_colors = array();
    protected $arr_quaters = array();
    protected $size = null;
    protected $seed = null;
    

    public function __get($name)
    {
        if($name == 'seed')
        {
            return $this->seed->str;
        }
        
        if($name == 'hash')
        {
            return $this->seed->hash;
        }
    }



    private function getFillOrder($code)
    {
        $arr = array(
            array(1,2,3,4),
            array(4,1,2,3),
            array(3,4,1,2),
            array(2,3,4,1),
            array(1,3,2,4),
            array(4,1,3,2),
            array(2,4,1,3),
            array(3,2,4,1),
            array(1,4,3,2),
            array(2,1,4,3),
            array(3,2,1,4),
            array(4,3,2,1),
            array(4,2,1,3),
            array(3,4,2,1),
            array(1,3,4,2),
            array(2,1,3,4)
        );

        return $arr[$code];
    }


    public function __construct($str_seed = null)
    {
        $this->size = new \stdClass();
        $this->size->width = 128;
        $this->size->height = 128;

        $this->seed = new \stdClass();

        if(is_null($str_seed))
        {
            date_default_timezone_set('UTC');

            $this->seed->str = date('YmdHis').uniqid();
            $this->seed->hash = md5($this->seed->str);
        }
        else
        {
            if(!is_string($str_seed))
            {
                throw new \InvalidArgumentException('The seed must be a valid string.');
            }

            $str_seed = trim($str_seed);

            if(strlen($str_seed) == 0)
            {
                throw new \InvalidArgumentException('String seed must not null string.');
            }

            $this->seed->str = $str_seed;
            $this->seed->hash = md5($str_seed);
        }
    }




    protected function generate($width = null, $height = null)
    {
        $str_base = '';

        // take 1 chars on 2
        foreach(str_split($this->seed->hash) as $k => $c)
        {
            if($k % 2)
            {
                $str_base .= $c;
            }
        }

        $arr_base = str_split($str_base, 2);
        $arr_order = $this->getFillOrder($arr_base[7][0]);
        
        $color = new Primitive\Color($arr_base[4].$arr_base[5].$arr_base[6]);

        foreach($arr_order as $o)
        {
            list($type, $subtype) = str_split($arr_base[$o - 1], 2);
        }
    }


    
    public function png()
    {
    } 



    public function svg()
    {
    }


    public function __toString()
    {
        return $this->svg();
    }

/*
    public function save($str_filename)
    {
        imagepng($this->image, $str_filename.'.png');
    }



    public function display()
    {
        header('Content-Type: image/png');
        $this->image = imagecreatetruecolor(12, 12);
        imagepng($this->image);
    }
    
    
    public function __destruct ()
    {
        imagedestroy($this->image);
        $this->image = null;
    }
 */
}
