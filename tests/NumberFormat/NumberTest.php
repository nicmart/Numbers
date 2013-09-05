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

        $this->assertEquals(11.24, $n1->round(4)->get());
        $this->assertEquals(0.00001124, $n2->round(4)->get());
        $this->assertEquals(-12320000000000, $n3->round(4)->get());
        $this->assertEquals(0, $n0->round(4)->get());
    }

    public function testMagnitude()
    {
        $n1 = new Number(11.235523);
        $n2 = new Number(-0.000011235523);
        $n3 = new Number(-12315639128398.232);
        $n0 = new Number(0);

        $this->assertEquals(1, $n1->getMagnitude());
        $this->assertEquals(-5, $n2->getMagnitude());
        $this->assertEquals(13, $n3->getMagnitude());
        $this->assertEquals(0, $n0->getMagnitude());
    }

    public function testIntegerPart()
    {
        $n1 = new Number(11.98982323);
        $n2 = new Number(0.000011235523);
        $n3 = new Number(-12315639128398.232);
        $n4 = new Number(-2.0);
        $n0 = new Number(0);

        $this->assertEquals(11, $n1->floor()->get());
        $this->assertEquals(0, $n2->floor()->get());
        $this->assertEquals(-12315639128399, $n3->floor()->get());
        $this->assertEquals(0, $n0->floor()->get());
        $this->assertEquals(-2, $n4->floor()->get());
    }

    public function testScientific()
    {
        $n1 = new Number(11.9898);
        $sc1 = $n1->getSciNotation();
        $n2 = new Number(0.000011235523);
        $sc2 = $n2->getSciNotation();
        $n3 = new Number(-12315639128398.232);
        $sc3 = $n3->getSciNotation();
        $n4 = new Number(-2.0);
        $sc4 = $n4->getSciNotation();
        $n0 = new Number(0);
        $sc0 = $n0->getSciNotation();

        $this->assertEquals(new SciNotation(1.19898, 1), $sc1);
        $this->assertEquals(new SciNotation(1.1235523, -5), $sc2);
        $this->assertEquals(new SciNotation(-1.2315639128398232, 13), $sc3);
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

        $this->assertEquals('1,123,232.9898232', $n1->format());
        $this->assertEquals('1 123 232,9898232', $n1->format(',', ' '));
        $this->assertEquals('0.000011235523', $n2->format());
        $this->assertEquals('-12,315,639,128,398', $n3->format());
        $this->assertEquals('-2.0', $n4->format());
        $this->assertEquals('0', $n0->format());
    }

    public function testSuffixNotation()
    {
        $n1 = new Number(11200000.0);
        $n2 = new Number(11.0);
        $n3 = new Number(-1231563913);
        $n4 = new Number(-22321.0);
        $n0 = new Number(0);

        $this->assertEquals('11.2M', (string) $n1->getSuffixNotation());
        $this->assertEquals('11', (string) $n2->getSuffixNotation());
        $this->assertEquals('-1.231563913G', (string) $n3->getSuffixNotation());
        $this->assertEquals('-22.321k', (string) $n4->getSuffixNotation());
        $this->assertEquals('0', (string) $n0->getSuffixNotation());
    }
}