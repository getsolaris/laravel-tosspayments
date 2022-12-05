<?php

namespace Getsolaris\LaravelTossPayments\tests;

use Getsolaris\LaravelTossPayments\Enums\ForeignCardCode;
use Getsolaris\LaravelTossPayments\Exceptions\InvalidInputTargetCodeException;
use PHPUnit\Framework\TestCase;

class ForeignCardCodeTest extends TestCase
{
    const TEST_VISA_CODE = '4V';

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
        $code = ForeignCardCode::toCode('비자');
        $this->assertSame(self::TEST_VISA_CODE, $code);
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
        $code = ForeignCardCode::toCode('VISA');
        $this->assertSame(self::TEST_VISA_CODE, $code);
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
        $code = ForeignCardCode::toCode(self::TEST_VISA_CODE);
        $this->assertSame(self::TEST_VISA_CODE, $code);
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
        ForeignCardCode::toCode('invalid');
    }
}
