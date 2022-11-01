# A Laravel package to Toss Payments


[![Latest Version on Packagist](https://img.shields.io/packagist/v/getsolaris/laravel-tosspayments.svg?style=flat-square)](https://packagist.org/packages/getsolaris/laravel-tosspayments)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/getsolaris/laravel-tosspayments/run-tests?label=tests)](https://github.com/getsolaris/laravel-tosspayments/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/getsolaris/laravel-tosspayments/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/getsolaris/laravel-tosspayments/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/getsolaris/laravel-tosspayments.svg?style=flat-square)](https://packagist.org/packages/getsolaris/laravel-tosspayments)


토스페이먼츠 (Toss Payments) 라라벨 API 입니다. 

# 설치
```bash
composer require getsolaris/laravel-tosspayments
```

`.env` 에 아래의 환경변수가 추가되어야 합니다.
Toss Payments 개발자센터에서 발급받은 클라이언트 키와 시크릿 키를 환경변수에 추가합니다.

```bash
TOSS_PAYMENTS_CLIENT_KEY=
TOSS_PAYMENTS_SECRET_KEY=
```

`config` 파일을 생성하기 위해서 아래 명령어를 수행합니다.

```bash
php artisan vendor:publish --provider="Getsolaris\LaravelTossPayments\TossPaymentsServiceProvider" --tag="config"
```

# 사용

Toss Payments 개발자센터의 [코어 API](https://docs.tosspayments.com/reference) 를 참고합니다.

API 를 사용하기 앞서 인증을 위한 API 키 준비와 인증 관련된 문서는 [해당 페이지](https://docs.tosspayments.com/guides/using-api)에서 확인 가능합니다.

Basic 인증 방식은 `{SECRET_KEY}:` 를 Base64 인코딩 한 값을 사용합니다.



## [결제 (Payment)](https://docs.tosspayments.com/reference#%EA%B2%B0%EC%A0%9C)

### [결제승인](https://docs.tosspayments.com/reference#%EA%B2%B0%EC%A0%9C-%EC%8A%B9%EC%9D%B8)

POST /v1/payments/confirm

```php
use Getsolaris\LaravelTossPayments\TossPayments;
use Getsolaris\LaravelTossPayments\Attributes\Payment;

$payment = TossPayments::for(Payment::class)
    ->paymentKey($paymentKey)
    ->orderId($orderId)
    ->amount($amount)
    ->confirm();

return $payment->json();
```



## [거래 (Transaction)](https://docs.tosspayments.com/reference#%EA%B1%B0%EB%9E%98)

### [거래 조회](https://docs.tosspayments.com/reference#%EA%B1%B0%EB%9E%98-%EC%A1%B0%ED%9A%8C)

GET /v1/transactions

```php
use Getsolaris\LaravelTossPayments\TossPayments;
use Getsolaris\LaravelTossPayments\Attributes\Transaction;

$transactions = TossPayments::for(Transaction::class)
    ->startDate('2022-01-01')
    ->endDate('2022-12-31')
    ->get();

return $transactions->json();
```



## [테스트 코드 사용하기](https://docs.tosspayments.com/reference/error-codes#%EC%97%90%EB%9F%AC-%EC%BD%94%EB%93%9C)

[에러코드](https://docs.tosspayments.com/reference/error-codes#%EC%97%90%EB%9F%AC-%EC%BD%94%EB%93%9C)를 확인하여
특정 에러가 발생했을 때와 같이 예상된 시나리오를 직접 발생시켜 처리해 볼 수 있습니다.

```php
use Getsolaris\LaravelTossPayments\TossPayments;
use Getsolaris\LaravelTossPayments\Attributes\Transaction;

$transactions = TossPayments::for(Transaction::class)
    ->startDate('2022-01-01T00:00:00')
    ->endDate('2022-12-31T00:00:00')
    ->testCode('INVALID_CARD_EXPIRATION')
    ->get();
```


## Resource
- [Toss Payments 개발자센터](https://developers.tosspayments.com/)
- [Toss Payments 코어 API](https://docs.tosspayments.com/reference)

## Changelog

Please see [CHANGELOG](../CHANGELOG.md) for more information on what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.