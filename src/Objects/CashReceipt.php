<?php

namespace Getsolaris\LaravelTossPayments\Objects;

class CashReceipt
{
    /**
     * @var string
     */
    public string $type;

    /**
     * @var string
     */
    public string $registrationNumber;

    /**
     * @var string
     */
    public string $businessNumber;

    public function __construct(string $type, string $registrationNumber, string $businessNumber)
    {
        $this->type = $type;
        $this->registrationNumber = $registrationNumber;
        $this->businessNumber = $businessNumber;
    }
}