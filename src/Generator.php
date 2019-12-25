<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
declare(strict_types=1);

namespace MSBios\CreditCard;

use MSBios\CreditCard\Exception\InvalidArgumentException;
use Zend\Math\Rand;

/**
 * Class Generator
 *
 * @package MSBios\CreditCard
 */
class Generator
{
    /**
     * Generates the random credit card number using the given prefix and
     * length. It uses default otherwise
     *
     * @param integer $prefix
     * @param integer $length
     *
     * @return string
     */
    public function single($prefix = null, $length = 16)
    {
        if ($length <= strlen((string)$prefix)) {
            throw InvalidArgumentException::wrongLengthParameters();
        }

        /** @var string $number */
        $number = $prefix.$this->generate($length - strlen((string)$prefix));

        return $number.(new LuhnCalculator)->verificationDigit($number);
    }

    /**
     * Generates the given amount of credit card numbers
     *
     * @param integer $amount
     * @param integer $prefix
     * @param integer $length
     *
     * @return integer[]
     */
    public function lot($amount, $prefix = null, $length = 16)
    {
        /** @var array $numbers */
        $numbers = [];
        for ($index = 1; $index <= $amount; $index++) {
            $numbers[] = $this->single($prefix, $length);
        }

        return $numbers;
    }

    /**
     * Retrieves a random number to put in the middle of card number
     *
     * Example:
     *     length = 5: Generates a number between 00000 and 99999
     *
     * @param integer $length
     *
     * @return integer
     */
    private function generate($length)
    {
        $rand = '';
        for ($index = 1; $index < $length; $index++) {
            $rand .= Rand::getInteger(0, 9);
        }

        return $rand;
    }
}
