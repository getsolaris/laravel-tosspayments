<?php

namespace Getsolaris\LaravelTossPayments\Enums;

final class ForeignCardCode extends CodeProvider
{
    const DINERS = [
        'code' => '6D',
        'kr' => '다이너스',
    ];

    const DISCOVER = [
        'code' => '6I',
        'kr' => '디스커버',
    ];

    const MASTER = [
        'code' => '4M',
        'kr' => '마스터',
    ];

    const UNIONPAY = [
        'code' => '3C',
        'kr' => '유니온페이',
    ];

    const JCB = [
        'code' => '4J',
        'kr' => null,
    ];

    const VISA = [
        'code' => '4V',
        'kr' => '비자',
    ];
}