## [정산 (Settlement)](https://docs.tosspayments.com/reference#%EC%A0%95%EC%82%B0)

### [정산 조회](https://docs.tosspayments.com/reference#%EC%A0%95%EC%82%B0-%EC%A1%B0%ED%9A%8C)

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

### [수동 정산 요청](https://docs.tosspayments.com/reference#%EC%88%98%EB%8F%99-%EC%A0%95%EC%82%B0-%EC%9A%94%EC%B2%AD)

POST /v1/settlements

```php
use Getsolaris\LaravelTossPayments\TossPayments;
use Getsolaris\LaravelTossPayments\Attributes\Settlement;

$settlement = TossPayments::for(Settlement::class)
    ->paymentKey($paymentKey)
    ->request();

return $settlement->json();
```
