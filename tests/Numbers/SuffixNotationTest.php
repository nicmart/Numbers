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
use Numbers\SuffixNotation;

class SuffixNotationTest extends \PHPUnit_Framework_TestCase
{
    public function testToString()
    {
        $n = new SuffixNotation(123.23, new MagnitudeSuffix(10));

        $this->assertEquals('123.23G', (string) $n);
    }
}
 