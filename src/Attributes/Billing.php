<?php

namespace Getsolaris\LaravelTossPayments\Attributes;

use Getsolaris\LaravelTossPayments\Contracts\AttributeInterface;
use Getsolaris\LaravelTossPayments\Objects\Vbv;
use Getsolaris\LaravelTossPayments\TossPayments;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;

class Billing extends TossPayments implements AttributeInterface
{
    protected string $uri;

    protected string $customerKey;

    protected string $cardNumber;

    protected string $cardExpirationYear;

    protected string $cardExpirationMonth;

    protected string $customerIdentityNumber;

    protected string $authKey;

    protected string $billingKey;

    protected int $amount;

    protected string $orderName;

    protected string $orderId;

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
        $this->uri = '/billing';

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
    public function customerKey(string $customerKey): static
    {
        $this->customerKey = $customerKey;

        return $this;
    }

    /**
     * @return $this
     */
    public function cardNumber(string $cardNumber): static
    {
        $this->cardNumber = $cardNumber;

        return $this;
    }

    /**
     * @return $this
     */
    public function cardExpirationYear(string $cardExpirationYear): static
    {
        $this->cardExpirationYear = $cardExpirationYear;

        return $this;
    }

    /**
     * @return $this
     */
    public function cardExpirationMonth(string $cardExpirationMonth): static
    {
        $this->cardExpirationMonth = $cardExpirationMonth;

        return $this;
    }

    /**
     * @return $this
     */
    public function customerIdentityNumber(string $customerIdentityNumber)
    {
        $this->customerIdentityNumber = $customerIdentityNumber;

        return $this;
    }

    public function authorizationsCard(
        ?string $cardPassword = null,
        ?string $customerName = null,
        ?string $customerEmail = null,
        ?Vbv $vbv = null
    ): PromiseInterface|Response {
        $parameters = [];
        if ($cardPassword) {
            $parameters['cardPassword'] = $cardPassword;
        }

        if ($customerName) {
            $parameters['customerName'] = $customerName;
        }

        if ($customerEmail) {
            $parameters['customerEmail'] = $customerEmail;
        }

        if ($vbv) {
            $parameters['vbv'] = (array) $vbv;
        }

        return $this->client->post($this->createEndpoint('/authorizations/card'), [
            'customerKey' => $this->customerKey,
            'cardNumber' => $this->cardNumber,
            'cardExpirationYear' => $this->cardExpirationYear,
            'cardExpirationMonth' => $this->cardExpirationMonth,
            'customerIdentityNumber' => $this->customerIdentityNumber,
        ] + $parameters);
    }

    public function authorizationsIssue(): PromiseInterface|Response
    {
        return $this->client->post($this->createEndpoint('/authorizations/issue'), [
            'authKey' => $this->authKey,
            'customerKey' => $this->customerKey,
        ]);
    }

    /**
     * @return $this
     */
    public function billingKey(string $billingKey): static
    {
        $this->billingKey = $billingKey;

        return $this;
    }

    public function amount(int $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    public function orderId(string $orderId): static
    {
        $this->orderId = $orderId;

        return $this;
    }

    public function orderName(string $orderName): static
    {
        $this->orderName = $orderName;

        return $this;
    }

    public function request(
        ?string $customerEmail = null,
        ?string $customerName = null,
        ?string $customerMobilePhone = null,
        ?int $taxFreeAmount = null,
        ?int $cardInstallmentPlan = null
    ): PromiseInterface|Response {
        $parameters = [];
        if ($customerEmail) {
            $parameters['customerEmail'] = $customerEmail;
        }

        if ($customerName) {
            $parameters['customerName'] = $customerName;
        }

        if ($customerMobilePhone) {
            $parameters['customerMobilePhone'] = $customerMobilePhone;
        }

        if ($taxFreeAmount) {
            $parameters['taxFreeAmount'] = $taxFreeAmount;
        }

        if ($cardInstallmentPlan) {
            $parameters['cardInstallmentPlan'] = $cardInstallmentPlan;
        }

        return $this->client->post($this->createEndpoint('/'.$this->billingKey), [
            'amount' => $this->amount,
            'customerKey' => $this->customerKey,
            'orderId' => $this->orderId,
            'orderName' => $this->orderName,
        ] + $parameters);
    }
}
