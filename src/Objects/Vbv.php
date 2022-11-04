<?php

namespace Getsolaris\LaravelTossPayments\Objects;

class Vbv
{
    /**
     * @var string
     */
    public string $cavv;

    /**
     * @var string
     */
    public string $xid;

    /**
     * @var string
     */
    public string $eci;

    public function __construct(string $cavv, string $xid, string $eci)
    {
        $this->cavv = $cavv;
        $this->xid = $xid;
        $this->eci = $eci;
    }
}
