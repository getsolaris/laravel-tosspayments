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

### [paymentKey로 결제 조회](https://docs.tosspayments.com/reference#paymentkey%EB%A1%9C-%EA%B2%B0%EC%A0%9C-%EC%A1%B0%ED%9A%8C)

GET /v1/payments/{paymentKey}

```php
use Getsolaris\LaravelTossPayments\TossPayments;
use Getsolaris\LaravelTossPayments\Attributes\Payment;

$payment = TossPayments::for(Payment::class)
    ->paymentKey($paymentKey)
    ->get();

return $payment->json();
```

### [orderId로 결제 조회](https://docs.tosspayments.com/reference#orderid%EB%A1%9C-%EA%B2%B0%EC%A0%9C-%EC%A1%B0%ED%9A%8C)

GET /v1/payments/orders/{orderId}

```php
use Getsolaris\LaravelTossPayments\TossPayments;
use Getsolaris\LaravelTossPayments\Attributes\Payment;

$payment = TossPayments::for(Payment::class)
    ->orderId($orderId)
    ->get();

return $payment->json();
```

### [결제 취소](https://docs.tosspayments.com/reference#%EA%B2%B0%EC%A0%9C-%EC%B7%A8%EC%86%8C)

POST /v1/payments/{paymentKey}/cancel

```php
use Getsolaris\LaravelTossPayments\TossPayments;
use Getsolaris\LaravelTossPayments\Attributes\Payment;

$payment = TossPayments::for(Payment::class)
    ->paymentKey($paymentKey)
    ->cancelReason('고객 변심')
    ->cancel(
        refundReceiveAccount: new RefundReceiveAccount(
            bank: '11',
            accountNumber: '111111111111',
            holderName: '홍길동'
        )
    );

return $payment->json();
```

### [카드 번호 결제](https://docs.tosspayments.com/reference#%EC%B9%B4%EB%93%9C-%EB%B2%88%ED%98%B8-%EA%B2%B0%EC%A0%9C)

POST /v1/payments/key-in

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


### [가상계좌 발급 요청](https://docs.tosspayments.com/reference#%EA%B0%80%EC%83%81%EA%B3%84%EC%A2%8C-%EB%B0%9C%EA%B8%89-%EC%9A%94%EC%B2%AD)

POST /v1/virtual-accounts

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