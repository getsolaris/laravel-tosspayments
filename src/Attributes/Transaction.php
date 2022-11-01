<?php

namespace Getsolaris\LaravelTossPayments\Attributes;

use Getsolaris\LaravelTossPayments\Contracts\AttributeInterface;
use Getsolaris\LaravelTossPayments\Exceptions\LargeLimitException;
use Getsolaris\LaravelTossPayments\TossPayments;

class Transaction extends TossPayments implements AttributeInterface
{
    /**
     * @var string $uri
     */
    protected string $uri;

    /**
     * @var string $startDate
     */
    protected string $startDate;

    /**
     * @var string $endDate
     */
    protected string $endDate;

    /**
     * @var string $startingAfter
     */
    protected string $startingAfter;

    /**
     * @var int limit
     */
    protected int $limit = 100;

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

    /**
     * @param  string|null  $endpoint
     * @return string
     */
    public function createEndpoint(?string $endpoint): string
    {
        return $this->url . $this->uri . $this->start($endpoint);
    }

    /**
     * @param  string  $startDate
     * @return $this
     */
    public function startDate(string $startDate): static
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * @param  string  $endDate
     * @return $this
     */
    public function endDate(string $endDate): static
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * @param  string  $startingAfter
     * @return $this
     */
    public function startingAfter(string $startingAfter): static
    {
        $this->startingAfter = $startingAfter;

        return $this;
    }

    /**
     * @return $this
     * @throws LargeLimitException
     */
    public function limit(int $limit): static
    {
        if ($limit > 10000) {
            throw new LargeLimitException();
        }

        $this->limit = $limit;

        return $this;
    }

    public function get()
    {
        return $this->client->get($this->createEndpoint('/'), [
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'startingAfter' => $this->startingAfter ?? null,
            'limit' => $this->limit,
        ]);
    }
}