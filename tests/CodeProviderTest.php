<?php

namespace Getsolaris\LaravelTossPayments\tests;

use Getsolaris\LaravelTossPayments\Enums\BankCode;
use Getsolaris\LaravelTossPayments\Enums\CodeProvider;
use Getsolaris\LaravelTossPayments\Exceptions\InvalidInputTargetCodeException;
use LogicException;
use PHPUnit\Framework\TestCase;

class CodeProviderTest extends TestCase
{
    const TEST_TOSSBANK_CODE = 92;
    const TEST_TOSSBANK_KR = '토스';

    /**
     * CodeProvider 클래스를 직접 호출하는 경우 예외처리
     *
     * @throws \ReflectionException
     * @throws InvalidInputTargetCodeException
     */
    public function testCodeProvider(): void
    {
        $this->expectException(LogicException::class);
        CodeProvider::toCode(self::TEST_TOSSBANK_CODE);
    }
}
