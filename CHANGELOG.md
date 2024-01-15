# Changelog

All notable changes to laravel-tosspayments will be documented in this file.

## v1.3.1 - 2024-01-15

### Laravel Toss Payments v1.3.1

- Laravel 10 지원

## v1.3 - 2022-12-11

### Laravel Toss Payments v1.3

- config 파일명이 `toss-payments.php` 에서 `tosspayments.php` 로 변경되었습니다.

#### [웹훅 (Webhook) 연동하기](https://docs.tosspayments.com/guides/webhook#%EC%9B%B9%ED%9B%85webhook-%EC%97%B0%EB%8F%99%ED%95%98%EA%B8%B0)

웹훅을 사용하기 전에 토스페이먼츠 개발자센터 웹훅 페이지에서 웹훅을 등록해주세요.

웹훅을 이용하기 전에 `config/tosspayments.php` 파일에서 `webhook` 설정을 확인해주세요.

```
'webhook' => [
    'handler' => [
        'controller' => \App\Http\Controllers\WebhookController::class,
        'method' => '__invoke',
    ],
],


```
`handler` 설정을 변경하여 웹훅을 처리할 컨트롤러와 메소드를 지정할 수 있습니다.

또한 아래의 명령어를 실행하여 기본 라우트 설정값인 `url/webhooks/tosspayments` 를 변경할 수 있습니다.

```bash
php artisan vendor:publish --provider="Getsolaris\LaravelTossPayments\TossPaymentsServiceProvider" --tag="webhook"


```
## v1.2 - 2022-12-05

### Laravel Toss Payments v1.2

토스페이먼츠 API `2022-11-16` 릴리즈로 큰 변화는 생기지 않았지만, 편의를 위해서 아래의 기능이 추가 되었습니다.

#### [숫자 기관 코드 사용](https://docs.tosspayments.com/reference/release-note#2022-11-16)

> 한글 영문 기관 코드를 [숫자 기관 코드](https://docs.tosspayments.com/reference/codes)로 대체합니다. 응답은 숫자 코드만 지원합니다. 요청은 숫자 한글 영문 코드를 지원하지만 숫자 코드 사용을 권장합니다. (토스페이먼츠 본문)

- 숫자 코드
- 한글 (kr) 코드 -> 숫자 코드 (code)
- 영문 (en) 코드 -> 숫자 코드 (code)

한글과 영문 코드는 [숫자 기관 코드](https://docs.tosspayments.com/reference/codes) 에서 명시된 코드만 지원합니다.

```php
<?php

namespace Getsolaris\LaravelTossPayments\tests;

use Getsolaris\LaravelTossPayments\Enums\BankCode;
use Getsolaris\LaravelTossPayments\Exceptions\InvalidInputTargetCodeException;
use PHPUnit\Framework\TestCase;

class BankCodeTest extends TestCase
{
    const TEST_TOSSBANK_CODE = 92;

    /**
     * 한글로 입력된 경우 코드로 변환
     *
     * @return void
     *
     * @throws InvalidInputTargetCodeException
     * @throws \ReflectionException
     */
    public function testConvertKrToCode(): void
    {
        $code = BankCode::toCode('토스');
        $this->assertSame(self::TEST_TOSSBANK_CODE, $code);
    }

    /**
     * 영문으로 입력된 경우 코드로 변환
     *
     * @return void
     *
     * @throws InvalidInputTargetCodeException
     * @throws \ReflectionException
     */
    public function testConvertEnToCode(): void
    {
        $code = BankCode::toCode('TOSSBANK');
        $this->assertSame(self::TEST_TOSSBANK_CODE, $code);
    }

    /**
     * 코드로 입력된 경우 올바른 코드인지 확인 후 반환
     *
     * @return void
     *
     * @throws InvalidInputTargetCodeException
     * @throws \ReflectionException
     */
    public function testAlwaysCode(): void
    {
        $code = BankCode::toCode(self::TEST_TOSSBANK_CODE);
        $this->assertSame(self::TEST_TOSSBANK_CODE, $code);
    }

    /**
     * 올바르지 않은 코드가 입력된 경우 예외처리 발생
     *
     * @return void
     *
     * @throws InvalidInputTargetCodeException
     * @throws \ReflectionException
     */
    public function testInvalidInputTargetCodeException(): void
    {
        $this->expectException(InvalidInputTargetCodeException::class);
        BankCode::toCode('invalid');
    }
}




```
기관 코드 변환을 지원하는 코드는 아래와 같습니다.

- 카드사 코드
- - 국내
  
- 
- - 해외
  
- 
- 
- 은행 코드

**Full Changelog**: https://github.com/getsolaris/laravel-tosspayments/compare/v1.1...v1.2

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
- 
- 
- - `orderId`로 결제 조회
  
- 
- 
- 
- 
- 
- 결제 취소

**Full Changelog**: https://github.com/getsolaris/laravel-tosspayments/compare/v1.0...v1.0.1
