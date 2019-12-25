<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
declare(strict_types=1);

namespace MSBios\CreditCard\Exception;

/**
 * Class InvalidArgumentException
 *
 * @package MSBios\CreditCard\Exception
 */
class InvalidArgumentException extends \MSBios\Exception\InvalidArgumentException
{
    /**
     * @return InvalidArgumentException
     */
    public static function wrongLengthParameters(): self
    {
        return self::create(
            'The \'length\' parameter should be greater than \'prefix\' '
            .'string length'
        );
    }
}
