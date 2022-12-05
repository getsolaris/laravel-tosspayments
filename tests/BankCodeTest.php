<?php

namespace Getsolaris\LaravelTossPayments\tests;

use Getsolaris\LaravelTossPayments\Enums\BankCode;
use Getsolaris\LaravelTossPayments\Exceptions\InvalidInputTargetCodeException;
use PHPUnit\Framework\TestCase;

class BankCodeTest extends TestCase
{
    const TEST_TOSSBANK_CODE = 92;

    /**
     * 한글로 입력된 경우 코드로 변환
     *
     * @return void
     *
     * @throws InvalidInputTargetCodeException
     * @throws \ReflectionException
     */
    public function testConvertKrToCode(): void
    {
        $code = BankCode::toCode('토스');
        $this->assertSame(self::TEST_TOSSBANK_CODE, $code);
    }

    /**
     * 영문으로 입력된 경우 코드로 변환
     *
     * @return void
     *
     * @throws InvalidInputTargetCodeException
     * @throws \ReflectionException
     */
    public function testConvertEnToCode(): void
    {
        $code = BankCode::toCode('TOSSBANK');
        $this->assertSame(self::TEST_TOSSBANK_CODE, $code);
    }

    /**
     * 코드로 입력된 경우 올바른 코드인지 확인 후 반환
     *
     * @return void
     *
     * @throws InvalidInputTargetCodeException
     * @throws \ReflectionException
     */
    public function testAlwaysCode(): void
    {
        $code = BankCode::toCode(self::TEST_TOSSBANK_CODE);
        $this->assertSame(self::TEST_TOSSBANK_CODE, $code);
    }

    /**
     * 올바르지 않은 코드가 입력된 경우 예외처리 발생
     *
     * @return void
     *
     * @throws InvalidInputTargetCodeException
     * @throws \ReflectionException
     */
    public function testInvalidInputTargetCodeException(): void
    {
        $this->expectException(InvalidInputTargetCodeException::class);
        BankCode::toCode('invalid');
    }
}
