<?php

namespace Getsolaris\LaravelTossPayments\tests;

use Getsolaris\LaravelTossPayments\Enums\CodeProvider;
use LogicException;
use PHPUnit\Framework\TestCase;

class CodeProviderTest extends TestCase
{
    const TEST_TOSSBANK_CODE = 92;

    const TEST_TOSSBANK_KR = '토스';

    public function testCodeProvider(): void
    {
        $this->expectException(LogicException::class);
        CodeProvider::toCode(self::TEST_TOSSBANK_CODE);
    }
}
