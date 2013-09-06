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
    public function format($decPoint = null, $separator = null)
    {
        if ($decPoint == null || $separator == null) {
            $locale = localeconv();

            if ($decPoint == null) {
                $decPoint = $locale["decimal_point"];
            }

            if ($separator == null) {
                $separator = $locale["thousands_sep"];
            }
        }
        
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
        $decimals = $this->significants - $this->getMagnitude() - 1;
        if ($preserveInts)
            $decimals = max(0, $decimals);

        return $decimals;
    }
}