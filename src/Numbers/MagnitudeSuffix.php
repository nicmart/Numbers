<?php
/**
 * This file is part of Numbers
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Nicolò Martini <nicmartnic@gmail.com>
 */

namespace Numbers;


class MagnitudeSuffix
{
    /**
     * @link http://en.wikipedia.org/wiki/Metric_prefix
     * @var string[]
     */
    public static $suffixes = array(
        -21 => 'z',
        -18 => 'a',
        -15 => 'f',
        -12 => 'p',
        -9 => 'n',
        -6 => 'µ',
        -3 => 'm',
        -2 => 'c',
        -1 => 'd',
        0 => '',
        1 => 'da',
        2 => 'h',
        3 => 'k',
        6 => 'M',
        9 => 'G',
        12 => 'T',
        15 => 'P',
        18 => 'E',
        21 => 'Z',
        24 => 'Y',
    );

    /**
     * @var int
     */
    private $magnitude;

    /**
     * @param $n
     * @return static
     */
    public static function fromNumber($n)
    {
        $number = new Number($n);

        return new static($number->getMagnitude());
    }

    /**
     * @param int $magnitude
     */
    public function __construct($magnitude)
    {
        $this->magnitude = $magnitude;
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return static::$suffixes[3 * floor($this->magnitude/3)];
    }
} 