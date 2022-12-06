<?php

namespace Getsolaris\LaravelTossPayments;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;

class TossPaymentRouteServiceProvider extends RouteServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/tosspayments.php');
    }
}