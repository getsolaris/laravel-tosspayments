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
    /**
     * @var string
     */
    protected string $uri;

    /**
     * @var string
     */
    protected string $paymentKey;

    /**
     * @var string
     */
    protected string $orderId;

    /**
     * @var string
     */
    protected string $cancelReason;

    /**
     * @var string
     */
    protected string $orderName;

    /**
     * @var string
     */
    protected string $customerName;

    /**
     * @var string
     */
    protected string $bank;

    /**
     * @var string
     */
    protected string $cardNumber;

    /**
     * @var string
     */
    protected string $cardExpirationYear;

    /**
     * @var string
     */
    protected string $cardExpirationMonth;

    /**
     * @var string
     */
    protected string $customerIdentityNumber;


    /**
     * @var int
     */
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
     * @param  string  $paymentKey
     * @return $this
     */
    public function paymentKey(string $paymentKey): static
    {
        $this->paymentKey = $paymentKey;

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
     * @param  int  $amount
     * @return $this
     */
    public function amount(int $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return PromiseInterface|Response
     */
    public function confirm(): PromiseInterface|Response
    {
        return $this->client->post($this->createEndpoint('/confirm'), [
            'paymentKey' => $this->paymentKey,
            'orderId' => $this->orderId,
            'amount' => $this->amount,
        ]);
    }

    /**
     * @return PromiseInterface|Response
     */
    public function get(): PromiseInterface|Response
    {
        return $this->client->get($this->createEndpoint('/'.($this->paymentKey ?? 'orders/'.$this->orderId)));
    }

    /**
     * @param  string  $cancelReason
     * @return $this
     */
    public function cancelReason(string $cancelReason): static
    {
        $this->cancelReason = $cancelReason;

        return $this;
    }

    /**
     * @param  int|null  $cancelAmount
     * @param  RefundReceiveAccount|null  $refundReceiveAccount
     * @param  int|null  $taxFreeAmount
     * @param  int|null  $refundableAmount
     * @return PromiseInterface|Response
     */
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
     * @param  string  $orderName
     * @return $this
     */
    public function orderName(string $orderName): static
    {
        $this->orderName = $orderName;

        return $this;
    }

    /**
     * @param  string  $customerName
     * @return $this
     */
    public function customerName(string $customerName): static
    {
        $this->customerName = $customerName;

        return $this;
    }

    /**
     * @param  string  $bank
     * @return $this
     */
    public function bank(string $bank): static
    {
        $this->bank = $bank;

        return $this;
    }

    /**
     * @param  string|null  $accountType
     * @param  string|null  $accountKey
     * @param  int|null  $validHours
     * @param  string|null  $dueDate
     * @param  string|null  $customerEmail
     * @param  string|null  $customerMobilePhone
     * @param  int|null  $taxFreeAmount
     * @param  bool|null  $useEscrow
     * @param  CashReceipt|null  $cashReceipt
     * @param  array|null  $escrowProducts
     * @return PromiseInterface|Response
     */
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
    ): PromiseInterface|Response
    {
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
     * @param  string  $cardNumber
     * @return $this
     */
    public function cardNumber(string $cardNumber): static
    {
        $this->cardNumber = $cardNumber;

        return $this;
    }

    /**
     * @param  string  $cardExpirationYear
     * @return $this
     */
    public function cardExpirationYear(string $cardExpirationYear): static
    {
        $this->cardExpirationYear = $cardExpirationYear;

        return $this;
    }

    /**
     * @param  string  $cardExpirationMonth
     * @return $this
     */
    public function cardExpirationMonth(string $cardExpirationMonth): static
    {
        $this->cardExpirationMonth = $cardExpirationMonth;

        return $this;
    }

    /**
     * @param  string  $customerIdentityNumber
     * @return $this
     */
    public function customerIdentityNumber(string $customerIdentityNumber)
    {
        $this->customerIdentityNumber = $customerIdentityNumber;

        return $this;
    }

    /**
     * @param  string|null  $cardPassword
     * @param  int|null  $cardInstallmentPlan
     * @param  bool|null  $useFreeInstallmentPlan
     * @param  int|null  $taxFreeAmount
     * @param  string|null  $customerEmail
     * @param  string|null  $customerName
     * @param  Vbv|null  $vbv
     * @return PromiseInterface|Response
     */
    public function keyIn(
        ?string $cardPassword = null,
        ?int $cardInstallmentPlan = null,
        ?bool $useFreeInstallmentPlan = null,
        ?int $taxFreeAmount = null,
        ?string $customerEmail = null,
        ?string $customerName = null,
        ?Vbv $vbv = null
    ): PromiseInterface|Response
    {
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
