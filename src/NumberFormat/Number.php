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
    public static $max_digit_precision = 14;

    private $number;
    private $precision;

    /**
     * @param $number
     */
    public function __construct($number)
    {
        $this->number = $number;
        $this->precision = static::$max_digit_precision;
    }

    /**
     * @param int $precision
     * @param bool $preserveInts
     * @return $this
     */
    public function round($precision, $preserveInts = false)
    {
        $this->precision = $precision;
        $decimals = $this->decimalsForPrecision($preserveInts);

        $this->number = round($this->number, $decimals);


        return $this;
    }

    /**
     * @return $this
     */
    public function floor()
    {
        $this->number = floor($this->number);

        return $this;
    }

    /**
     * @return $this
     */
    public function ceil()
    {
        $this->number = ceil($this->number);

        return $this;
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->number;
    }

    /**
     * Apply a function to the underlying number
     *
     * @param callable $callable
     * @return $this
     */
    public function apply($callable)
    {
        $this->number = call_user_func($callable, $this->number);

        return $this;
    }

    /**
     * Return the order of getMagnitude of the number
     * @param int $base
     * @return int
     */
    public function getMagnitude($base = 10)
    {
        if ($this->number == 0)
            return 0;

        return floor(log(abs($this->number), $base));
    }

    /**
     * @return int
     */
    public function getSign()
    {
        if ($this->number > 0)
            return 1;
        if ($this->number < 0)
            return -1;

        return 0;
    }

    /**
     * @return SciNotation
     */
    public function getSciNotation()
    {
        $magnitude = $this->getMagnitude();
        return new SciNotation(pow(10, -$magnitude) * $this->number, $magnitude);
    }

    /**
     * @return SuffixNotation
     */
    public function getSuffixNotation()
    {
        $magnitude = $this->getMagnitude();
        $exp = 3 * floor($magnitude/3);

        return new SuffixNotation(pow(10, -$exp) * $this->number, new MagnitudeSuffix($magnitude));
    }

    /**
     * @param string $decPoint
     * @param string $separator
     * @return string
     */
    public function format($decPoint = '.', $separator = ',')
    {
        $decimals = $this->decimalsForPrecision();
        $string = number_format(round($this->number, $decimals), $decimals, $decPoint, $separator);

        $string = rtrim(rtrim($string, $decPoint), '0');

        return $string;
    }

    /**
     * @param bool $preserveInts
     * @return int|mixed
     */
    private function decimalsForPrecision($preserveInts = true)
    {
        $decimals = $this->precision - $this->getMagnitude() - 1;
        if ($preserveInts)
            $decimals = max(0, $decimals);

        return $decimals;
    }
}