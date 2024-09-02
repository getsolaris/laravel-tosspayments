<?php

namespace Getsolaris\LaravelTossPayments\Attributes;

use Getsolaris\LaravelTossPayments\Contracts\AttributeInterface;
use Getsolaris\LaravelTossPayments\Exceptions\LargeLimitException;
use Getsolaris\LaravelTossPayments\TossPayments;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;

class Transaction extends TossPayments implements AttributeInterface
{
    protected string $uri;

    protected string $startDate;

    protected string $endDate;

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
        $this->uri = '/transactions';

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

    /**
     * @throws LargeLimitException
     */
    public function get(?string $startingAfter = null, ?int $limit = null): PromiseInterface|Response
    {
        $parameters = [];
        if ($startingAfter) {
            $parameters['startingAfter'] = $startingAfter;
        }

        if ($limit) {
            if ($limit > 10000) {
                throw new LargeLimitException;
            }

            $parameters['limit'] = $limit;
        }

        return $this->client->get($this->createEndpoint('/'), [
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
        ] + $parameters);
    }
}
