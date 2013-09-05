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


use Numbers\MagnitudeSuffix;

class MagnitudeSuffixTest extends \PHPUnit_Framework_TestCase
{
    public function testToString()
    {
        $this->assertEquals('µ', (string) (new MagnitudeSuffix(-6)));
        $this->assertEquals('µ', (string) (new MagnitudeSuffix(-5)));
        $this->assertEquals('µ', (string) (new MagnitudeSuffix(-4)));
        $this->assertEquals('m', (string) (new MagnitudeSuffix(-3)));
        $this->assertEquals('m', (string) (new MagnitudeSuffix(-2)));
        $this->assertEquals('m', (string) (new MagnitudeSuffix(-1)));
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

    public function testFromNumber()
    {
        $m = MagnitudeSuffix::fromNumber(112321);
        $this->assertEquals('k', (string) $m);

        $m = MagnitudeSuffix::fromNumber(0.001232);
        $this->assertEquals('m', (string) $m);
    }
}
 