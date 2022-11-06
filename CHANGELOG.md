# Changelog

All notable changes to laravel-tosspayments will be documented in this file.

## v1.1 - 2022-11-06

### Laravel Toss Payments v1.1

#### [자동 결제 (Billing)](https://docs.tosspayments.com/reference#%EC%9E%90%EB%8F%99-%EA%B2%B0%EC%A0%9C)

##### [customerKey로 카드 자동 결제 빌링키 발급 요청](https://docs.tosspayments.com/reference#customerkey%EB%A1%9C-%EC%B9%B4%EB%93%9C-%EC%9E%90%EB%8F%99-%EA%B2%B0%EC%A0%9C-%EB%B9%8C%EB%A7%81%ED%82%A4-%EB%B0%9C%EA%B8%89-%EC%9A%94%EC%B2%AD)

POST /v1/billing/authorizations/card

```php
use Getsolaris\LaravelTossPayments\TossPayments;
use Getsolaris\LaravelTossPayments\Attributes\Billing;

$billing = TossPayments::for(Billing::class)
    ->customerKey($customerKey)
    ->cardNumber($cardNumber)
    ->cardExpirationYear($cardExpirationYear)
    ->cardExpirationMonth($cardExpirationMonth)
    ->customerIdentityNumber($customerIdentityNumber)
    ->authorizationsCard();

return $billing->json();

```
##### [authKey로 카드 자동 결제 빌링키 발급 요청](https://docs.tosspayments.com/reference#authkey%EB%A1%9C-%EC%B9%B4%EB%93%9C-%EC%9E%90%EB%8F%99-%EA%B2%B0%EC%A0%9C-%EB%B9%8C%EB%A7%81%ED%82%A4-%EB%B0%9C%EA%B8%89-%EC%9A%94%EC%B2%AD)

POST /v1/billing/authorizations/issue

```php
use Getsolaris\LaravelTossPayments\TossPayments;
use Getsolaris\LaravelTossPayments\Attributes\Billing;

$billing = TossPayments::for(Billing::class)
    ->customerKey($customerKey)
    ->authKey($authKey)
    ->authorizationsIssue();

return $billing->json();

```
##### [카드 자동 결제 승인 요청](https://docs.tosspayments.com/reference#%EC%B9%B4%EB%93%9C-%EC%9E%90%EB%8F%99-%EA%B2%B0%EC%A0%9C-%EC%8A%B9%EC%9D%B8-%EC%9A%94%EC%B2%AD)

POST /v1/billing/{billingKey}

```php
use Getsolaris\LaravelTossPayments\TossPayments;
use Getsolaris\LaravelTossPayments\Attributes\Billing;

$billing = TossPayments::for(Billing::class)
    ->customerKey($customerKey)
    ->authKey($authKey)
    ->authorizationsIssue();

return $billing->json();

```
#### [정산 (Settlement)](https://docs.tosspayments.com/reference#%EC%A0%95%EC%82%B0)

##### [정산 조회](https://docs.tosspayments.com/reference#%EC%A0%95%EC%82%B0-%EC%A1%B0%ED%9A%8C)

GET /v1/settlements

```php
use Getsolaris\LaravelTossPayments\TossPayments;
use Getsolaris\LaravelTossPayments\Attributes\Settlement;

$settlements = TossPayments::for(Settlement::class)
    ->startDate($startDate)
    ->endDate($endDate)
    ->get();

return $settlements->json();

```
##### [수동 정산 요청](https://docs.tosspayments.com/reference#%EC%88%98%EB%8F%99-%EC%A0%95%EC%82%B0-%EC%9A%94%EC%B2%AD)

POST /v1/settlements

```php
use Getsolaris\LaravelTossPayments\TossPayments;
use Getsolaris\LaravelTossPayments\Attributes\Settlement;

$settlement = TossPayments::for(Settlement::class)
    ->paymentKey($paymentKey)
    ->request();

return $settlement->json();

```
#### [현금영수증 (CashReceipt)](https://docs.tosspayments.com/reference#%ED%98%84%EA%B8%88%EC%98%81%EC%88%98%EC%A6%9D)

##### [현금영수증 발급](https://docs.tosspayments.com/reference#%ED%98%84%EA%B8%88%EC%98%81%EC%88%98%EC%A6%9D)

POST /v1/cash-receipts

```php
use Getsolaris\LaravelTossPayments\TossPayments;
use Getsolaris\LaravelTossPayments\Attributes\CashReceipt;

$cashReceipt = TossPayments::for(CashReceipt::class)
    ->amount($amount)
    ->orderId($orderId)
    ->orderName($orderName)
    ->customerIdentityNumber($customerIdentityNumber)
    ->type($type)
    ->request();

return $cashReceipt->json();

```
##### [현금영수증 발급 취소](https://docs.tosspayments.com/reference#%ED%98%84%EA%B8%88%EC%98%81%EC%88%98%EC%A6%9D-%EB%B0%9C%EA%B8%89-%EC%B7%A8%EC%86%8C)

POST /v1/cash-receipts/{receiptKey}/cancel

```php
use Getsolaris\LaravelTossPayments\TossPayments;
use Getsolaris\LaravelTossPayments\Attributes\CashReceipt;

$cashReceipt = TossPayments::for(CashReceipt::class)
    ->receiptKey($receiptKey)
    ->cancel();

return $cashReceipt->json();

```
##### [현금영수증 조회](https://docs.tosspayments.com/reference#%ED%98%84%EA%B8%88%EC%98%81%EC%88%98%EC%A6%9D-%EC%A1%B0%ED%9A%8C)

GET /v1/cash-receipts

```php
use Getsolaris\LaravelTossPayments\TossPayments;
use Getsolaris\LaravelTossPayments\Attributes\CashReceipt;

$cashReceipts = TossPayments::for(CashReceipt::class)
    ->requestDate($requestDate)
    ->get();

return $cashReceipts->json();

```
#### [카드사 혜택 조회 (CardPromotion)](https://docs.tosspayments.com/reference#%EC%B9%B4%EB%93%9C%EC%82%AC-%ED%98%9C%ED%83%9D-%EC%A1%B0%ED%9A%8C)

##### [카드사 혜택 조회](https://docs.tosspayments.com/reference#%EC%B9%B4%EB%93%9C%EC%82%AC-%ED%98%9C%ED%83%9D-%EC%A1%B0%ED%9A%8C-1)

GET /v1/promotions/card

```php
use Getsolaris\LaravelTossPayments\TossPayments;
use Getsolaris\LaravelTossPayments\Attributes\Promotion;

$promotions = TossPayments::for(Promotion::class)
    ->get();

return $promotions->json();

```
**Full Changelog**: https://github.com/getsolaris/laravel-tosspayments/compare/v1.0.2...v1.1

## v1.0.2 - 2022-11-04

### Laravel Toss Payments v1.0.2

- 카드 번호 결제

```php
use Getsolaris\LaravelTossPayments\TossPayments;
use Getsolaris\LaravelTossPayments\Attributes\Payment;

$keyIn = TossPayments::for(Payment::class)
    ->amount($amount)
    ->orderId($orderId)
    ->orderName($orderName)
    ->cardNumber($cardNumber)
    ->cardExpirationYear($cardExpirationYear)
    ->cardExpirationMonth($cardExpirationMonth)
    ->customerIdentityNumber($customerIdentityNumber)
    ->keyIn();

return $keyIn->json();


```
- 가상계좌 발급 요청

```php
use Getsolaris\LaravelTossPayments\TossPayments;
use Getsolaris\LaravelTossPayments\Attributes\Payment;

$virtualAccounts = TossPayments::for(Payment::class)
    ->amount($amount)
    ->orderId($orderId)
    ->orderName($orderName)
    ->customerName($customerName)
    ->bank('우리')
    ->virtualAccounts();

return $virtualAccounts->json();


```
**Full Changelog**: https://github.com/getsolaris/laravel-tosspayments/compare/v1.0.1...v1.0.2

## v1.0.1 - 2022-11-02

### Laravel Toss Payments v1.0.1

- 결제 조회
- - `paymentId`로 결제 조회
- 
- 
- - `orderId`로 결제 조회
- 
- 
- 
- 결제 취소

**Full Changelog**: https://github.com/getsolaris/laravel-tosspayments/compare/v1.0...v1.0.1
