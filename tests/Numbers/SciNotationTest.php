<?php
/**
 * This file is part of Numbers
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Nicolò Martini <nicmartnic@gmail.com>
 */

namespace Numbers\Test;


use Numbers\SciNotation;

class SciNotationTest extends \PHPUnit_Framework_TestCase
{
    public function testToString()
    {
        $not = new SciNotation(1.232, -4);
        $this->assertEquals("1.232 &times; 10<sup>-4</sup>", (string) $not);

        $not->magnitude = 0;
        $this->assertEquals("1.232", (string) $not);

        $not->magnitude = 90;
        $this->assertEquals("1.232 &times; 10<sup>90</sup>", (string) $not);
    }
}
 