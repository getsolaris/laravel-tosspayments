<?php

use Getsolaris\LaravelTossPayments\Handlers\TossPaymentsWebhookHandler;

Route::post('webhooks/tosspayments', [TossPaymentsWebhookHandler::class, '__invoke']);
