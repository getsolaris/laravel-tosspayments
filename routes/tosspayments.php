<?php

use Getsolaris\LaravelTossPayments\Controllers\WebhookController;
use Illuminate\Support\Facades\Route;

Route::prefix('tosspayments')->group(function () {
    Route::any('webhook', [WebhookController::class, '__invoke']);
});
