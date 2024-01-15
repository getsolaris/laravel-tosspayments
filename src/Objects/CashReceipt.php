<?php

namespace Getsolaris\LaravelTossPayments\Objects;

class CashReceipt
{
    public string $type;

    public string $registrationNumber;

    public string $businessNumber;

    public function __construct(string $type, string $registrationNumber, string $businessNumber)
    {
        $this->type = $type;
        $this->registrationNumber = $registrationNumber;
        $this->businessNumber = $businessNumber;
    }
}
