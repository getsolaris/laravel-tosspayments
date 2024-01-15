<?php

namespace Getsolaris\LaravelTossPayments\Attributes;

use Getsolaris\LaravelTossPayments\Contracts\AttributeInterface;
use Getsolaris\LaravelTossPayments\Objects\CashReceipt;
use Getsolaris\LaravelTossPayments\Objects\RefundReceiveAccount;
use Getsolaris\LaravelTossPayments\Objects\Vbv;
use Getsolaris\LaravelTossPayments\TossPayments;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;

class Payment extends TossPayments implements AttributeInterface
{
    protected string $uri;

    protected string $paymentKey;

    protected string $orderId;

    protected string $cancelReason;

    protected string $orderName;

    protected string $customerName;

    protected string $bank;

    protected string $cardNumber;

    protected string $cardExpirationYear;

    protected string $cardExpirationMonth;

    protected string $customerIdentityNumber;

    protected int $amount;

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
        $this->uri = '/payments';

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
    public function paymentKey(string $paymentKey): static
    {
        $this->paymentKey = $paymentKey;

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
    public function amount(int $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    public function confirm(): PromiseInterface|Response
    {
        return $this->client->post($this->createEndpoint('/confirm'), [
            'paymentKey' => $this->paymentKey,
            'orderId' => $this->orderId,
            'amount' => $this->amount,
        ]);
    }

    public function get(): PromiseInterface|Response
    {
        return $this->client->get($this->createEndpoint('/'.($this->paymentKey ?? 'orders/'.$this->orderId)));
    }

    /**
     * @return $this
     */
    public function cancelReason(string $cancelReason): static
    {
        $this->cancelReason = $cancelReason;

        return $this;
    }

    public function cancel(
        ?int $cancelAmount = null,
        ?RefundReceiveAccount $refundReceiveAccount = null,
        ?int $taxFreeAmount = null,
        ?int $refundableAmount = null
    ): PromiseInterface|Response {
        $parameters = [];
        if ($cancelAmount) {
            $parameters['cancelAmount'] = $cancelAmount;
        }

        if ($refundReceiveAccount) {
            $parameters['refundReceiveAccount'] = (array) $refundReceiveAccount;
        }

        if ($taxFreeAmount) {
            $parameters['taxFreeAmount'] = $taxFreeAmount;
        }

        if ($refundableAmount) {
            $parameters['refundableAmount'] = $refundableAmount;
        }

        return $this->client->post($this->createEndpoint('/'.$this->paymentKey.'/cancel'), [
            'cancelReason' => $this->cancelReason,
        ] + $parameters);
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
    public function customerName(string $customerName): static
    {
        $this->customerName = $customerName;

        return $this;
    }

    /**
     * @return $this
     */
    public function bank(string $bank): static
    {
        $this->bank = $bank;

        return $this;
    }

    public function virtualAccounts(
        ?string $accountType = null,
        ?string $accountKey = null,
        ?int $validHours = null,
        ?string $dueDate = null,
        ?string $customerEmail = null,
        ?string $customerMobilePhone = null,
        ?int $taxFreeAmount = null,
        ?bool $useEscrow = null,
        ?CashReceipt $cashReceipt = null,
        ?array $escrowProducts = null
    ): PromiseInterface|Response {
        $parameters = [];
        if ($accountType) {
            $parameters['accountType'] = $accountType;
        }

        if ($accountKey) {
            $parameters['accountKey'] = $accountKey;
        }

        if ($validHours) {
            $parameters['validHours'] = $validHours;
        }

        if ($dueDate) {
            $parameters['dueDate'] = $dueDate;
        }

        if ($customerEmail) {
            $parameters['customerEmail'] = $customerEmail;
        }

        if ($customerMobilePhone) {
            $parameters['customerMobilePhone'] = $customerMobilePhone;
        }

        if ($taxFreeAmount) {
            $parameters['taxFreeAmount'] = $taxFreeAmount;
        }

        if ($useEscrow) {
            $parameters['useEscrow'] = $useEscrow;
        }

        if ($cashReceipt) {
            $parameters['cashReceipt'] = (array) $cashReceipt;
        }

        if ($escrowProducts) {
            $parameters['escrowProducts'] = $escrowProducts;
        }

        return $this->client->post($this->createEndpoint('/virtual-accounts', false), [
            'amount' => $this->amount,
            'orderId' => $this->orderId,
            'orderName' => $this->orderName,
            'customerName' => $this->customerName,
            'bank' => $this->bank,
        ] + $parameters);
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

    public function keyIn(
        ?string $cardPassword = null,
        ?int $cardInstallmentPlan = null,
        ?bool $useFreeInstallmentPlan = null,
        ?int $taxFreeAmount = null,
        ?string $customerEmail = null,
        ?string $customerName = null,
        ?Vbv $vbv = null
    ): PromiseInterface|Response {
        $parameters = [];
        if ($cardPassword) {
            $parameters['cardPassword'] = $cardPassword;
        }

        if ($cardInstallmentPlan) {
            $parameters['cardInstallmentPlan'] = $cardInstallmentPlan;
        }

        if ($useFreeInstallmentPlan) {
            $parameters['useFreeInstallmentPlan'] = $useFreeInstallmentPlan;
        }

        if ($taxFreeAmount) {
            $parameters['taxFreeAmount'] = $taxFreeAmount;
        }

        if ($customerEmail) {
            $parameters['customerEmail'] = $customerEmail;
        }

        if ($customerName) {
            $parameters['customerName'] = $customerName;
        }

        if ($vbv) {
            $parameters['vbv'] = (array) $vbv;
        }

        return $this->client->post($this->createEndpoint('/key-in'), [
            'amount' => $this->amount,
            'orderId' => $this->orderId,
            'orderName' => $this->orderName,
            'cardNumber' => $this->cardNumber,
            'cardExpirationYear' => $this->cardExpirationYear,
            'cardExpirationMonth' => $this->cardExpirationMonth,
            'customerIdentityNumber' => $this->customerIdentityNumber,
        ] + $parameters);
    }
}
