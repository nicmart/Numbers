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

/**
 * Class SciNotation
 * @package Numbers
 */
class SciNotation
{
    /** @var float */
    public $mantissa;

    /** @var int */
    public $magnitude;

    /**
     * @param $mantissa
     * @param int $magnitude
     */
    public function __construct($mantissa, $magnitude = 0)
    {
        $this->mantissa = $mantissa;
        $this->magnitude = $magnitude;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $result = (string) $this->mantissa;

        if ($this->magnitude)
            $result .= " &times; 10<sup>{$this->magnitude}</sup>";

        return $result;
    }
} 