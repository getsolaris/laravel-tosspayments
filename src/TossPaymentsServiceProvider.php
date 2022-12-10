<?php

namespace Getsolaris\LaravelTossPayments;

use Illuminate\Support\ServiceProvider;

class TossPaymentsServiceProvider extends ServiceProvider
{
    /**
     * @var string
     */
    private string $name = 'tosspayments';

    /**
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__."/../config/{$this->name}.php", $this->name);

        $this->app->bind(TossPayments::class, function ($app) {
            return TossPayments::for($app['request']);
        });
    }

    /**
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__."/../config/{$this->name}.php" => config_path($this->name.'.php'),
        ], 'config');

        $this->publishes([
            __DIR__."/../routes/{$this->name}.php" => base_path('routes/'.$this->name.'.php'),
            __DIR__."/../src/Webhooks/TossPaymentsWebhook.php" => base_path('app/Webhooks/TossPaymentsWebhook.php'),
        ], 'webhook');
    }
}
