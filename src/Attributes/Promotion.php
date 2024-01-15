<?php

namespace Getsolaris\LaravelTossPayments\Attributes;

use Getsolaris\LaravelTossPayments\Contracts\AttributeInterface;
use Getsolaris\LaravelTossPayments\TossPayments;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;

class Promotion extends TossPayments implements AttributeInterface
{
    protected string $uri;

    public function __construct()
    {
        parent::__construct($this);
        $this->initializeUri();
    }

    public function initializeUri(): static
    {
        $this->uri = '/promotions';

        return $this;
    }

    public function createEndpoint(?string $endpoint, bool $withUri = true): string
    {
        if ($withUri) {
            return $this->url.$this->uri.$this->start($endpoint);
        }

        return $this->url.$this->start($endpoint);
    }

    public function get(): PromiseInterface|Response
    {
        return $this->client->get($this->createEndpoint('/card'));
    }
}
