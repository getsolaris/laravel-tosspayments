<?php

namespace Getsolaris\LaravelTossPayments\Objects;

class Vbv
{
    public string $cavv;

    public string $xid;

    public string $eci;

    public function __construct(string $cavv, string $xid, string $eci)
    {
        $this->cavv = $cavv;
        $this->xid = $xid;
        $this->eci = $eci;
    }
}
