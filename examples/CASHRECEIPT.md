## [현금영수증 (CashReceipt)](https://docs.tosspayments.com/reference#%ED%98%84%EA%B8%88%EC%98%81%EC%88%98%EC%A6%9D)

### [현금영수증 발급](https://docs.tosspayments.com/reference#%ED%98%84%EA%B8%88%EC%98%81%EC%88%98%EC%A6%9D)

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

### [현금영수증 발급 취소](https://docs.tosspayments.com/reference#%ED%98%84%EA%B8%88%EC%98%81%EC%88%98%EC%A6%9D-%EB%B0%9C%EA%B8%89-%EC%B7%A8%EC%86%8C)

POST /v1/cash-receipts/{receiptKey}/cancel

```php
use Getsolaris\LaravelTossPayments\TossPayments;
use Getsolaris\LaravelTossPayments\Attributes\CashReceipt;

$cashReceipt = TossPayments::for(CashReceipt::class)
    ->receiptKey($receiptKey)
    ->cancel();

return $cashReceipt->json();
```

### [현금영수증 조회](https://docs.tosspayments.com/reference#%ED%98%84%EA%B8%88%EC%98%81%EC%88%98%EC%A6%9D-%EC%A1%B0%ED%9A%8C)

GET /v1/cash-receipts

```php
use Getsolaris\LaravelTossPayments\TossPayments;
use Getsolaris\LaravelTossPayments\Attributes\CashReceipt;

$cashReceipts = TossPayments::for(CashReceipt::class)
    ->requestDate($requestDate)
    ->get();

return $cashReceipts->json();
```