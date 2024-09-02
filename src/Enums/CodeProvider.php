<?php

namespace Getsolaris\LaravelTossPayments\Enums;

use Getsolaris\LaravelTossPayments\Exceptions\InvalidInputTargetCodeException;
use LogicException;

class CodeProvider
{
    /**
     * @throws InvalidInputTargetCodeException
     * @throws \ReflectionException
     */
    public static function toCode(int|string $code): string|int
    {
        $class = static::class;
        if ($class === self::class) {
            throw new LogicException(static::class.' 클래스를 직접 호출할 수 없습니다.');
        }

        if (defined($class.'::'.$code)) {
            return constant($class.'::'.$code)['code'];
        }

        $constants = (new \ReflectionClass($class))->getConstants();
        foreach ($constants as $constant) {
            if ($constant['code'] === $code) {
                return $constant['code'];
            }

            if ($constant['kr'] === $code) {
                return $constant['code'];
            }
        }

        throw new InvalidInputTargetCodeException;
    }
}
