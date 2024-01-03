<?php

namespace Getsolaris\LaravelTossPayments\Enums;

final class ForeignCardCode extends CodeProvider
{
    public const DINERS = [
        'code' => '6D',
        'kr' => '다이너스',
    ];

    public const DISCOVER = [
        'code' => '6I',
        'kr' => '디스커버',
    ];

    public const MASTER = [
        'code' => '4M',
        'kr' => '마스터',
    ];

    public const UNIONPAY = [
        'code' => '3C',
        'kr' => '유니온페이',
    ];

    public const JCB = [
        'code' => '4J',
        'kr' => null,
    ];

    public const VISA = [
        'code' => '4V',
        'kr' => '비자',
    ];
}
