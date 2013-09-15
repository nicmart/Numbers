<?php
/*
 * This file is part of Numbers.
 *
 * (c) 2013 Nicolò Martini
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Numbers;

/**
 * Class Number
 */
class Number
{
    /**
     * {@link http://php.net/manual/en/language.types.float.php}
     * @var int
     */
    public static $max_significants = 14;

    private $number;
    private $significants;

    /**
     * @param int|float $number
     * @return static
     */
    public static function n($number)
    {
        return new static($number);
    }

    /**
     * @param $number
     */
    public function __construct($number)
    {
        $this->number = $number;
        $this->significants = static::$max_significants;
    }

    /**
     * @param int $significants
     * @param bool $preserveInts
     * @return $this
     */
    public function round($significants, $preserveInts = false)
    {
        $this->significants = $significants;
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
     * @return int
     */
    public function getMagnitude()
    {
        if ($this->number == 0)
            return 0;

        return floor(log10(abs($this->number)));
    }

    /**
     * Returns the n-th digit of the number in base $n, where n is the exponent of
     * $base in the expansion of $this->number in base $base
     *
     * As usual keep in mind that float precision is limited, so there can be errors
     * when the digit is of a magnitude 12-13 times smaller than the magnitude of
     * the numnber.
     *
     * @param int $n
     * @param int $base
     * @return float
     */
    public function getDigit($n, $base = 10)
    {
        $m = abs($this->number) / pow($base, $n);
        return $m % $base;
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
     * @param int $magnitude
     *
     * @return SuffixNotation
     */
    public function getSuffixNotation($magnitude = null)
    {
        $magnitude = isset($magnitude) ? $magnitude : $this->getMagnitude();
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

        $string = rtrim(rtrim($string, '0'), $decPoint);

        return $string;
    }

    /**
     * This is the same of format(), only that it will fallback to machine locale values
     * when some argument is missing.
     *
     * @param string|null $decPoint
     * @param string|null $separator
     * @return string
     */
    public function localeFormat($decPoint = null, $separator = null)
    {
        if (!isset($decPoint) || !isset($separator)) {
            $locale = localeconv();

            if (!isset($decPoint))
                $decPoint = $locale["decimal_point"];

            if (!isset($separator))
                $separator = $locale["thousands_sep"];
        }

        return $this->format($decPoint, $separator);
    }

    /**
     * @param bool $preserveInts
     * @return int|mixed
     */
    private function decimalsForPrecision($preserveInts = true)
    {
        $decimals = $this->significants - $this->getMagnitude() - 1;
        if ($preserveInts)
            $decimals = max(0, $decimals);

        return $decimals;
    }
}