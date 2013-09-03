<?php
/**
 * This file is part of NumberFormat
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Nicolò Martini <nicmartnic@gmail.com>
 */

namespace NumberFormat;

/**
 * Class SciNotation
 * @package NumberFormat
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
} 