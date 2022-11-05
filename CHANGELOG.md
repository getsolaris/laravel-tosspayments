# Changelog

All notable changes to laravel-tosspayments will be documented in this file.

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
- - `orderId`로 결제 조회
- 
- 
- 결제 취소

**Full Changelog**: https://github.com/getsolaris/laravel-tosspayments/compare/v1.0...v1.0.1
