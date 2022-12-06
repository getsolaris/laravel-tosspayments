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