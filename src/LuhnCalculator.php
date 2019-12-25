<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
declare(strict_types=1);

namespace MSBios\CreditCard;

/**
 * It calculates the sum of a given number using Luhn's algorithm
 *
 * Class LuhnCalculator
 *
 * @package MSBios\CreditCard
 */
class LuhnCalculator
{
    /**
     * Executes Luhn algorithm over the given number and return the sum. This
     * method does not include last digit of credit card number (verification
     * digit).
     *
     * @param string|integer $number
     *
     * @return integer
     */
    public function sum($number): int
    {
        /** @var array $numberArray */
        $numberArray = array_reverse(str_split($number));

        /** @var integer $result */
        $result = 0;

        /** @var integer $index */
        for ($index = 0; $index < count($numberArray); $index++) {

            /** @var integer $digit */
            $digit = (int)$numberArray[$index];
            $result += ($index % 2 == 0) ? $this->multiplyNumber($digit) : $digit;
        }
        return $result;
    }

    /**
     * Retrives the corresponding verfication digit of the given credit card
     * number. If the verification digit is ten, returns zero
     *
     * @param string|integer $number
     * @return integer
     */
    public function verificationDigit($number)
    {
        return 10 - ($this->sum($number) % 10 ?: 10);
    }

    /**
     * Multiplies number by two and decrease 9 if the number is greater than 10
     *
     * @param integer $number
     * @return integer
     */
    private function multiplyNumber($number)
    {
        $result = $number * 2;
        return ($result >= 10) ? $result - 9 : $result;
    }
}
