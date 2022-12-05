<?php

namespace Getsolaris\LaravelTossPayments\Enums;

use Getsolaris\LaravelTossPayments\Exceptions\InvalidInputTargetCodeException;

class CodeProvider
{
    /**
     * @throws \ReflectionException
     * @throws InvalidInputTargetCodeException
     */
    public static function toCode(int|string $code)
    {
        $class = get_called_class();
        if (defined($class.'::'.$code)) {
            return constant($class.'::'.$code)['code'];
        }

        $constants = (new \ReflectionClass($class))->getConstants();
        foreach ($constants as $constant) {
            if ($constant['code'] === $code) {
                return $constant['code'];
            } elseif ($constant['kr'] === $code) {
                return $constant['code'];
            }
        }

        throw new InvalidInputTargetCodeException();
    }
}
