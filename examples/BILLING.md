## [자동 결제 (Billing)](https://docs.tosspayments.com/reference#%EC%9E%90%EB%8F%99-%EA%B2%B0%EC%A0%9C)

### [customerKey로 카드 자동 결제 빌링키 발급 요청](https://docs.tosspayments.com/reference#customerkey%EB%A1%9C-%EC%B9%B4%EB%93%9C-%EC%9E%90%EB%8F%99-%EA%B2%B0%EC%A0%9C-%EB%B9%8C%EB%A7%81%ED%82%A4-%EB%B0%9C%EA%B8%89-%EC%9A%94%EC%B2%AD)

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

### [authKey로 카드 자동 결제 빌링키 발급 요청](https://docs.tosspayments.com/reference#authkey%EB%A1%9C-%EC%B9%B4%EB%93%9C-%EC%9E%90%EB%8F%99-%EA%B2%B0%EC%A0%9C-%EB%B9%8C%EB%A7%81%ED%82%A4-%EB%B0%9C%EA%B8%89-%EC%9A%94%EC%B2%AD)

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

### [카드 자동 결제 승인 요청](https://docs.tosspayments.com/reference#%EC%B9%B4%EB%93%9C-%EC%9E%90%EB%8F%99-%EA%B2%B0%EC%A0%9C-%EC%8A%B9%EC%9D%B8-%EC%9A%94%EC%B2%AD)

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