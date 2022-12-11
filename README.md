# A Laravel package to Toss Payments


[![Latest Version on Packagist](https://img.shields.io/packagist/v/getsolaris/laravel-tosspayments.svg?style=flat-square)](https://packagist.org/packages/getsolaris/laravel-tosspayments)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/getsolaris/laravel-tosspayments/run-tests?label=tests)](https://github.com/getsolaris/laravel-tosspayments/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/getsolaris/laravel-tosspayments/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/getsolaris/laravel-tosspayments/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)


토스페이먼츠 (Toss Payments) 라라벨 API 입니다. 

### API 버전: 2022-11-16
[API 버전 정책](https://docs.tosspayments.com/reference/versioning#%EB%82%B4-%EC%83%81%EC%A0%90%EC%9D%98-api-%EB%B2%84%EC%A0%84-%ED%99%95%EC%9D%B8%EB%B3%80%EA%B2%BD%ED%95%98%EA%B8%B0)

| Version | API Version |
|---------|-------------|
| v1.2    | 2022-11-16  |
| v1.1    | 2022-07-27  |

---

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

[예제 보기](examples/PAYMENT.md)


## [거래 (Transaction)](https://docs.tosspayments.com/reference#%EA%B1%B0%EB%9E%98)

[예제 보기](examples/TRANSACTION.md)


## [자동 결제 (Billing)](https://docs.tosspayments.com/reference#%EC%9E%90%EB%8F%99-%EA%B2%B0%EC%A0%9C)

[예제 보기](examples/BILLING.md)


## [정산 (Settlement)](https://docs.tosspayments.com/reference#%EC%A0%95%EC%82%B0)

[예제 보기](examples/SETTLEMENT.md)


## [현금영수증 (CashReceipt)](https://docs.tosspayments.com/reference#%ED%98%84%EA%B8%88%EC%98%81%EC%88%98%EC%A6%9D)

[예제 보기](examples/CASHRECEIPT.md)


## [카드사 혜택 조회 (Promotion)](https://docs.tosspayments.com/reference#%EC%B9%B4%EB%93%9C%EC%82%AC-%ED%98%9C%ED%83%9D-%EC%A1%B0%ED%9A%8C)

[예제 보기](examples/PROMOTION.md)

## [웹훅 (Webhook) 연동하기](https://docs.tosspayments.com/guides/webhook#%EC%9B%B9%ED%9B%85webhook-%EC%97%B0%EB%8F%99%ED%95%98%EA%B8%B0)

웹훅을 사용하기 전에 토스페이먼츠 개발자센터 웹훅 페이지에서 웹훅을 등록해주세요.

웹훅을 이용하기 전에 `config/tosspayments.php` 파일에서 `webhook` 설정을 확인해주세요.

기본 웹훅 설정값입니다.
- `queue` 는 `config('queue.default')` 로 설정되어 있습니다.
- `controller` 는 `Getsolaris\LaravelTossPayments\Controllers\WebhookController` 로 설정되어 있습니다.

하지만 따로 수정을 하기 위해서는 아래의 명령어를 수행합니다.

```bash
php artisan vendor:publish --provider="Getsolaris\LaravelTossPayments\TossPaymentsServiceProvider" --tag="webhook"
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

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
