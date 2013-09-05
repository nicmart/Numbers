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


class SuffixNotation
{
    public $number;
    public $suffix;

    public function __construct($number, MagnitudeSuffix $suffix)
    {
        $this->number = $number;
        $this->suffix = $suffix;
    }

    public function __toString()
    {
        return $this->number . (string) $this->suffix;
    }
} 