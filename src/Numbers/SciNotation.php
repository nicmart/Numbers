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
    public $significand;

    /** @var int */
    public $magnitude;

    /**
     * @param $significand
     * @param int $magnitude
     */
    public function __construct($significand, $magnitude = 0)
    {
        $this->significand = $significand;
        $this->magnitude = $magnitude;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $result = (string) $this->significand;

        if ($this->magnitude)
            $result .= " &times; 10<sup>{$this->magnitude}</sup>";

        return $result;
    }
} 