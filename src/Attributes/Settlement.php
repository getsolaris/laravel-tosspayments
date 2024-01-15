<?php

namespace Getsolaris\LaravelTossPayments\Attributes;

use Getsolaris\LaravelTossPayments\Contracts\AttributeInterface;
use Getsolaris\LaravelTossPayments\TossPayments;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;

class Settlement extends TossPayments implements AttributeInterface
{
    protected string $uri;

    protected string $startDate;

    protected string $endDate;

    protected string $paymentKey;

    public function __construct()
    {
        parent::__construct($this);
        $this->initializeUri();
    }

    /**
     * @return $this
     */
    public function initializeUri(): static
    {
        $this->uri = '/settlements';

        return $this;
    }

    public function createEndpoint(?string $endpoint, bool $withUri = true): string
    {
        if ($withUri) {
            return $this->url.$this->uri.$this->start($endpoint);
        }

        return $this->url.$this->start($endpoint);
    }

    /**
     * @return $this
     */
    public function startDate(string $startDate): static
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * @return $this
     */
    public function endDate(string $endDate): static
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function get(
        ?string $dataType = null,
        ?int $page = null,
        ?int $size = null
    ): PromiseInterface|Response {
        $parameters = [];
        if ($dataType) {
            $parameters['dataType'] = $dataType;
        }

        if ($page) {
            $parameters['page'] = $page;
        }

        if ($size) {
            $parameters['size'] = $size;
        }

        return $this->client->get($this->createEndpoint('/'), [
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
        ] + $parameters);
    }

    /**
     * @return $this
     */
    public function paymentKey(string $paymentKey): static
    {
        $this->paymentKey = $paymentKey;

        return $this;
    }

    public function request(): PromiseInterface|Response
    {
        return $this->client->get($this->createEndpoint('/'), [
            'paymentKey' => $this->paymentKey,
        ]);
    }
}
