<?php

namespace Getsolaris\LaravelTossPayments\Objects;

class RefundReceiveAccount
{
    /**
     * @var string
     */
    public string $bank;

    /**
     * @var string
     */
    public string $accountNumber;

    /**
     * @var string
     */
    public string $holderName;

    public function __construct(string $bank, string $accountNumber, string $holderName)
    {
        $this->bank = $bank;
        $this->accountNumber = $accountNumber;
        $this->holderName = $holderName;
    }
}
