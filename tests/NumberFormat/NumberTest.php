<?php
/*
 * This file is part of NumberFormat.
 *
 * (c) 2013 Nicolò Martini
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace NumberFormat\Test;

use NumberFormat\Number;
use NumberFormat\SciNotation;

/**
 * Unit tests for class Number
 */
class NumberTest extends \PHPUnit_Framework_TestCase
{
    public function testRound()
    {
        $n1 = new Number(11.235523);
        $n2 = new Number(0.000011235523);
        $n3 = new Number(-12315639128398.232);
        $n0 = new Number(0);

        $this->assertEquals(11.24, $n1->round(4));
        $this->assertEquals(0.00001124, $n2->round(4));
        $this->assertEquals(-12320000000000, $n3->round(4));
        $this->assertEquals(0, $n0->round(4));
    }

    public function testMagnitude()
    {
        $n1 = new Number(11.235523);
        $n2 = new Number(-0.000011235523);
        $n3 = new Number(-12315639128398.232);
        $n0 = new Number(0);

        $this->assertEquals(1, $n1->magnitude());
        $this->assertEquals(-5, $n2->magnitude());
        $this->assertEquals(13, $n3->magnitude());
        $this->assertEquals(0, $n0->magnitude());
    }

    public function testIntegerPart()
    {
        $n1 = new Number(11.98982323);
        $n2 = new Number(0.000011235523);
        $n3 = new Number(-12315639128398.232);
        $n4 = new Number(-2.0);
        $n0 = new Number(0);

        $this->assertEquals(11, $n1->integerPart());
        $this->assertEquals(0, $n2->integerPart());
        $this->assertEquals(-12315639128399, $n3->integerPart());
        $this->assertEquals(0, $n0->integerPart());
        $this->assertEquals(-2, $n4->integerPart());
    }

    public function testScientific()
    {
        $n1 = new Number(11.98982323);
        $sc1 = $n1->scientific(5);
        $n2 = new Number(0.000011235523);
        $sc2 = $n2->scientific(4);
        $n3 = new Number(-12315639128398.232);
        $sc3 = $n3->scientific(3);
        $n4 = new Number(-2.0);
        $sc4 = $n4->scientific(20);
        $n0 = new Number(0);
        $sc0 = $n0->scientific(20);

        $this->assertEquals(new SciNotation(1.199, 1), $sc1);
        $this->assertEquals(new SciNotation(1.124, -5), $sc2);
        $this->assertEquals(new SciNotation(-1.23, 13), $sc3);
        $this->assertEquals(new SciNotation(-2.0, 0), $sc4);
        $this->assertEquals(new SciNotation(0, 0), $sc0);
    }

    public function testFormat()
    {
        $n1 = new Number(1123232.9898232);
        $n2 = new Number(0.000011235523);
        $n3 = new Number(-12315639128398.232);
        $n4 = new Number(-2.0);
        $n0 = new Number(0);

        $this->assertEquals('1,123,233', $n1->format());
        $this->assertEquals('1,123,232.99', $n1->format(9));
        $this->assertEquals('0.00001124', $n2->format(4));
        $this->assertEquals('-12,315,639,128,398', $n3->format());
        $this->assertEquals('-2.0', $n4->format());
        $this->assertEquals('0', $n0->format());
    }
}