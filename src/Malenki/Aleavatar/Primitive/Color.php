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
 * Define color object to be used both by SVG constructor and GD PNG 
 * constructor. 
 * 
 * @property-read integer $r Red channel, an integer value (0-255)
 * @property-read integer $g Green channel, an integer value (0-255)
 * @property-read integer $b Blue channel, an integer value (0-255)
 * @author Michel Petit <petit.michel@gmail.com> 
 * @license MIT
 */
class Color
{
    /**
     * Stores the red value. 
     * 
     * @var integer
     * @access protected
     */
    
    protected $r = null;
    /**
     * Stores the green value. 
     * 
     * @var integer
     * @access protected
     */
    protected $g = null;

    /**
     * Stores the blue value. 
     * 
     * @var integer
     * @access protected
     */
    protected $b = null;



    public function __get($name)
    {
        if(in_array($name, array('r', 'g', 'b')))
        {
            return $this->$name;
        }
    }



    /**
     * Constructor, taking hexadecimal string without leading sharp. 
     * 
     * @param string $str_hex 
     * @throws InvalidArgumentException If string deos not have six characters.
     * @access public
     * @return void
     */
    public function __construct($str_hex)
    {
        if(strlen($str_hex) != 6)
        {
            throw new \InvalidArgumentException(
                'Hexadecimal color string must have 6 characters!'
            );
        }

        list($this->r, $this->g, $this->b) = str_split($str_hex, 2);

        $this->r = hexdec($this->r);
        $this->g = hexdec($this->g);
        $this->b = hexdec($this->b);
    }


    /**
     * Defined an exported color for GD image.
     * 
     * @param resource $img Image resource GD 
     * @access public
     * @return integer Color image allocation
     */
    public function gd(&$img)
    {
        return imagecolorallocate($img, $this->r, $this->g, $this->b);
    }


    /**
     * Renders color as hexadecimal string suitable for CSS or XML with leading 
     * sharp character.
     * 
     * @access public
     * @return string
     */
    public function __toString()
    {
        return sprintf('#%02x%02x%02x', $this->r, $this->g, $this->b);
    }
}
