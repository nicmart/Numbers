<?php
/*
 * This file is part of Numbers.
 *
 * (c) 2013 Nicolò Martini
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Numbers\Test;

use Numbers\Number;
use Numbers\SciNotation;

/**
 * Unit tests for class Number
 */
class NumberTest extends \PHPUnit_Framework_TestCase
{
    public function testStaticCreation()
    {
        $n1 = Number::n(1.123232);
        $this->assertEquals(new Number(1.123232), $n1);
    }

    public function testGet()
    {
        $n1 = new Number(11.235523);
        $this->assertEquals(11.235523, $n1->get());
    }

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
        $n0 = new Number(0);
        $n1 = new Number(11.235523);
        $n2 = new Number(-0.000011235523);
        $n3 = new Number(-12315639128398.232);
        $n4 = new Number(1000);
        $n5 = new Number(999.999999);
        $n6 = new Number(0.01);

        $this->assertEquals(0, $n0->getMagnitude());
        $this->assertEquals(1, $n1->getMagnitude());
        $this->assertEquals(-5, $n2->getMagnitude());
        $this->assertEquals(13, $n3->getMagnitude());
        $this->assertEquals(3, $n4->getMagnitude());
        $this->assertEquals(2, $n5->getMagnitude());
        $this->assertEquals(-2, $n6->getMagnitude());
    }

    public function testGetDigit()
    {
        $this->assertEquals(9, Number::n(123456789.1234)->getDigit(0));
        $this->assertEquals(9, Number::n(-123456789.1234)->getDigit(0));
        $this->assertEquals(8, Number::n(123456789.1234)->getDigit(1));
        $this->assertEquals(8, Number::n(-123456789.1234)->getDigit(1));
        $this->assertEquals(7, Number::n(123456789.1234)->getDigit(2));
        $this->assertEquals(6, Number::n(123456789.1234)->getDigit(3));
        $this->assertEquals(5, Number::n(123456789.1234)->getDigit(4));
        $this->assertEquals(8, Number::n(123456789.1234)->getDigit(1));

        $this->assertEquals(1, Number::n(123456789.1234)->getDigit(-1));
        $this->assertEquals(2, Number::n(123456789.1234)->getDigit(-2));
        $this->assertEquals(3, Number::n(123456789.1234)->getDigit(-3));
        //These fails: precision too low
        //$this->assertEquals(4, Number::n(123456789.1234)->getDigit(-4));
        //$this->assertEquals(1, Number::n(10000000000001)->getDigit(0));

    }

    public function testGetDigitWithNonDecimalBase()
    {
        $this->assertEquals(1, Number::n(bindec('1010010101'))->getDigit(0, 2));
        $this->assertEquals(0, Number::n(bindec('1010010101'))->getDigit(1, 2));
        $this->assertEquals(1, Number::n(bindec('1010010101'))->getDigit(2, 2));
        $this->assertEquals(0, Number::n(bindec('1010010101'))->getDigit(3, 2));
        $this->assertEquals(1, Number::n(bindec('1010010101'))->getDigit(4, 2));
        $this->assertEquals(1, Number::n(bindec('1010010101'))->getDigit(9, 2));

    }

    public function testFloor()
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

    public function testCeil()
    {
        $n1 = new Number(11.98982323);
        $n2 = new Number(0.000011235523);
        $n3 = new Number(-12315639128398.232);
        $n4 = new Number(-2.0);
        $n0 = new Number(0);

        $this->assertEquals(12, $n1->ceil()->get());
        $this->assertEquals(1, $n2->ceil()->get());
        $this->assertEquals(-12315639128398, $n3->ceil()->get());
        $this->assertEquals(0, $n0->ceil()->get());
        $this->assertEquals(-2, $n4->ceil()->get());
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
        $n0 = new Number(0);
        $n1 = new Number(1123232.9898232);
        $n2 = new Number(0.000011235523);
        $n3 = new Number(-12315639128398.232);
        $n4 = new Number(-2.0);
        $n5 = new Number(16.0);


        $this->assertEquals('0', $n0->format('.', ','));
        $this->assertEquals('1,123,232.9898232', $n1->format('.', ','));
        $this->assertEquals('1 123 232,9898232', $n1->format(',', ' '));
        $this->assertEquals('0.000011235523', $n2->format('.', ','));
        $this->assertEquals('-12,315,639,128,398', $n3->format('.', ','));
        $this->assertEquals('-2', $n4->format());
        $this->assertEquals('16', $n5->format());
    }

    public function testLocaleFormat()
    {
        $locale = localeconv();
        $n1 = new Number(1123232.9898232);

        $this->assertEquals('1,123,232.9898232', $n1->localeFormat('.', ','));
        $this->assertEquals($n1->format('.', $locale["thousands_sep"]), $n1->localeFormat('.', null));
        $this->assertEquals($n1->format($locale["decimal_point"], ','), $n1->localeFormat(null, ','));
    }

    public function testGetSuffixNotation()
    {
        $n1 = new Number(11200000.0);
        $n2 = new Number(11.0);
        $n3 = new Number(-1231563913);
        $n4 = new Number(-22321.0);
        $n0 = new Number(0);
        $n5 = new Number(1000);

        $this->assertEquals('11.2M', (string) $n1->getSuffixNotation());
        $this->assertEquals('11', (string) $n2->getSuffixNotation());
        $this->assertEquals('-1.231563913G', (string) $n3->getSuffixNotation());
        $this->assertEquals('-22.321k', (string) $n4->getSuffixNotation());
        $this->assertEquals('0', (string) $n0->getSuffixNotation());
        $this->assertEquals('1k', (string) $n5->getSuffixNotation());
    }

    public function testApply()
    {
        $n1 = new Number(2);
        $this->assertEquals(sqrt(2), $n1->apply('sqrt')->get());
    }
}