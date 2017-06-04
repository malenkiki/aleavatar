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
 * Define diamond shapes.
 *
 * @author Michel Petit <petit.michel@gmail.com>
 * @license MIT
 */
class Diamond extends Polygon
{
    /**
     * Sets one point by giving its coordinates.
     *
     * @param  integer           $int_x
     * @param  integer           $int_y
     * @throws \RuntimeException If you try to set 5th point.
     * @access public
     * @return Diamond
     */
    public function point($int_x, $int_y)
    {
        if (count($this->arr_points) >= 4) {
            throw new \RuntimeException('Diamond has only four points!');
        }

        return parent::point($int_x, $int_y);
    }

}
