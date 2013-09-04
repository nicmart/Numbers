<?php
/**
 * This file is part of NumberFormat
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Nicolò Martini <nicmartnic@gmail.com>
 */

namespace NumberFormat\Test;


use NumberFormat\MagnitudeSuffix;

class MagnitudeSuffixTest extends \PHPUnit_Framework_TestCase
{
    public function testToString()
    {
        $this->assertEquals('m', (string) (new MagnitudeSuffix(-4)));
        $this->assertEquals('m', (string) (new MagnitudeSuffix(-3)));
        $this->assertEquals('', (string) (new MagnitudeSuffix(-2)));
        $this->assertEquals('', (string) (new MagnitudeSuffix(-1)));
        $this->assertEquals('', (string) (new MagnitudeSuffix(0)));
        $this->assertEquals('', (string) (new MagnitudeSuffix(1)));
        $this->assertEquals('', (string) (new MagnitudeSuffix(2)));
        $this->assertEquals('k', (string) (new MagnitudeSuffix(3)));
        $this->assertEquals('k', (string) (new MagnitudeSuffix(4)));
        $this->assertEquals('k', (string) (new MagnitudeSuffix(5)));
        $this->assertEquals('M', (string) (new MagnitudeSuffix(6)));
        $this->assertEquals('M', (string) (new MagnitudeSuffix(7)));
        $this->assertEquals('M', (string) (new MagnitudeSuffix(8)));
    }
}
 