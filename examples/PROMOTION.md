## [카드사 혜택 조회 (Promotion)](https://docs.tosspayments.com/reference#%EC%B9%B4%EB%93%9C%EC%82%AC-%ED%98%9C%ED%83%9D-%EC%A1%B0%ED%9A%8C)

### [카드사 혜택 조회](https://docs.tosspayments.com/reference#%EC%B9%B4%EB%93%9C%EC%82%AC-%ED%98%9C%ED%83%9D-%EC%A1%B0%ED%9A%8C-1)

GET /v1/promotions/card

```php
use Getsolaris\LaravelTossPayments\TossPayments;
use Getsolaris\LaravelTossPayments\Attributes\Promotion;

$promotions = TossPayments::for(Promotion::class)
    ->get();

return $promotions->json();
```