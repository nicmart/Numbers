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
     * @param boolean $preserveInts
     * @return int|float
     * @return float
     */
    public function round($precision, $preserveInts = false)
    {
        $decimals = $this->decimalsForPrecision($precision, $preserveInts);

        return round($this->number, $decimals);
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
     * @return int
     */
    public function sign()
    {
        if ($this->number > 0)
            return 1;
        if ($this->number < 0)
            return -1;

        return 0;
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

    /**
     * @param int $precision
     * @param string $separator
     * @param bool $preserveInts
     * @return string
     */
    public function format($precision = 3, $separator = ',', $preserveInts = true)
    {
        $decimals = $this->decimalsForPrecision($precision, $preserveInts);
        $string = number_format(round($this->number, $decimals), $decimals, '.', $separator);

        $string = rtrim(rtrim($string, '.'), '0');

        return $string;
    }

    private function decimalsForPrecision($precision, $preserveInts = true)
    {
        $decimals = $precision - $this->magnitude() - 1;
        if ($preserveInts)
            $decimals = max(0, $decimals);

        return $decimals;
    }
}