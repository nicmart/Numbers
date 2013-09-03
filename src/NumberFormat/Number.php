<?php
/*
 * This file is part of NumberFormat.
 *
 * (c) 2013 Nicolò Martini
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NumberFormat;

/**
 * Class Number
 */
class Number
{
    private $number;

    /**
     * @param $number
     */
    public function __construct($number)
    {
        $this->number = $number;
    }

    /**
     * @param int $precision
     * @return int|float
     * @return float
     */
    public function round($precision)
    {
        return round($this->number, $precision - $this->magnitude() - 1);
    }

    /**
     * @return float
     */
    public function integerPart()
    {
        return floor($this->number);
    }

    /**
     * Return the order of magnitude of the number
     * @param int $base
     * @return int
     */
    public function magnitude($base = 10)
    {
        if ($this->number == 0)
            return 0;

        return floor(log(abs($this->number), $base));
    }

    /**
     * @param $precision
     * @return SciNotation
     */
    public function scientific($precision)
    {
        $magnitude = $this->magnitude();
        return new SciNotation(pow(10, -$magnitude) * $this->round($precision), $magnitude);
    }
}