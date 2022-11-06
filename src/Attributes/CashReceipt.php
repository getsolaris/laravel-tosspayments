<?php

namespace Getsolaris\LaravelTossPayments\Attributes;

use Getsolaris\LaravelTossPayments\Contracts\AttributeInterface;
use Getsolaris\LaravelTossPayments\TossPayments;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;

class CashReceipt extends TossPayments implements AttributeInterface
{
    /**
     * @var string
     */
    protected string $uri;

    /**
     * @var string
     */
    protected string $receiptKey;

    /**
     * @var int
     */
    protected int $amount;

    /**
     * @var string
     */
    protected string $orderId;

    /**
     * @var string
     */
    protected string $orderName;

    /**
     * @var string
     */
    protected string $customerIdentityNumber;

    /**
     * @var string
     */
    protected string $type;

    /**
     * @var string
     */
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

    /**
     * @param  string|null  $endpoint
     * @param  bool  $withUri
     * @return string
     */
    public function createEndpoint(?string $endpoint, bool $withUri = true): string
    {
        if ($withUri) {
            return $this->url.$this->uri.$this->start($endpoint);
        }

        return $this->url.$this->start($endpoint);
    }

    /**
     * @param  string  $receiptKey
     * @return $this
     */
    public function receiptKey(string $receiptKey): static
    {
        $this->receiptKey = $receiptKey;

        return $this;
    }

    /**
     * @param  int  $amount
     * @return $this
     */
    public function amount(int $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @param  string  $orderId
     * @return $this
     */
    public function orderId(string $orderId): static
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * @param  string  $orderName
     * @return $this
     */
    public function orderName(string $orderName): static
    {
        $this->orderName = $orderName;

        return $this;
    }

    /**
     * @param  string  $customerIdentityNumber
     * @return $this
     */
    public function customerIdentityNumber(string $customerIdentityNumber): static
    {
        $this->customerIdentityNumber = $customerIdentityNumber;

        return $this;
    }

    /**
     * @param  string  $type
     * @return $this
     */
    public function type(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param  int|null  $taxFreeAmount
     * @return PromiseInterface|Response
     */
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

    /**
     * @param  int|null  $amount
     * @return PromiseInterface|Response
     */
    public function cancel(?int $amount = null): PromiseInterface|Response
    {
        $parameters = [];
        if ($amount) {
            $parameters['amount'] = $amount;
        }

        return $this->client->post($this->createEndpoint('/'.$this->receiptKey.'/cancel'), $parameters);
    }

    /**
     * @param  string  $requestDate
     * @return $this
     */
    public function requestDate(string $requestDate): static
    {
        $this->requestDate = $requestDate;

        return $this;
    }

    /**
     * @param  int|null  $cursor
     * @param  int|null  $limit
     * @return PromiseInterface|Response
     */
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
