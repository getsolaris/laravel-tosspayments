<?php

namespace Getsolaris\LaravelTossPayments\Attributes;

use Getsolaris\LaravelTossPayments\Contracts\AttributeInterface;
use Getsolaris\LaravelTossPayments\TossPayments;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;

class CashReceipt extends TossPayments implements AttributeInterface
{
    protected string $uri;

    protected string $receiptKey;

    protected int $amount;

    protected string $orderId;

    protected string $orderName;

    protected string $customerIdentityNumber;

    protected string $type;

    protected string $requestDate;

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
        $this->uri = '/cash-receipts';

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
    public function receiptKey(string $receiptKey): static
    {
        $this->receiptKey = $receiptKey;

        return $this;
    }

    /**
     * @return $this
     */
    public function amount(int $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return $this
     */
    public function orderId(string $orderId): static
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * @return $this
     */
    public function orderName(string $orderName): static
    {
        $this->orderName = $orderName;

        return $this;
    }

    /**
     * @return $this
     */
    public function customerIdentityNumber(string $customerIdentityNumber): static
    {
        $this->customerIdentityNumber = $customerIdentityNumber;

        return $this;
    }

    /**
     * @return $this
     */
    public function type(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function request(?int $taxFreeAmount = null): PromiseInterface|Response
    {
        $parameters = [];
        if ($taxFreeAmount) {
            $parameters['taxFreeAmount'] = $taxFreeAmount;
        }

        return $this->client->post($this->createEndpoint('/'), [
            'amount' => $this->amount,
            'orderId' => $this->orderId,
            'orderName' => $this->orderName,
            'customerIdentityNumber' => $this->customerIdentityNumber,
            'type' => $this->type,
        ] + $parameters);
    }

    public function cancel(?int $amount = null): PromiseInterface|Response
    {
        $parameters = [];
        if ($amount) {
            $parameters['amount'] = $amount;
        }

        return $this->client->post($this->createEndpoint('/'.$this->receiptKey.'/cancel'), $parameters);
    }

    /**
     * @return $this
     */
    public function requestDate(string $requestDate): static
    {
        $this->requestDate = $requestDate;

        return $this;
    }

    public function get(?int $cursor = null, ?int $limit = null): PromiseInterface|Response
    {
        $parameters = [];
        if ($cursor) {
            $parameters['cursor'] = $cursor;
        }

        if ($limit) {
            $parameters['limit'] = $limit;
        }

        return $this->client->get($this->createEndpoint('/'), [
            'requestDate' => $this->requestDate,
        ] + $parameters);
    }
}
