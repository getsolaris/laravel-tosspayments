<?php

namespace Getsolaris\LaravelTossPayments\Handlers;

use Getsolaris\LaravelTossPayments\Exceptions\WebhookPayloadException;

class TossPaymentsWebhookHandler
{
    /**
     * @throws WebhookPayloadException
     * @throws \ReflectionException
     */
    public function __invoke()
    {
        $payload = json_decode(request()->getContent(), true);

        if (! $payload) {
            throw new WebhookPayloadException();
        }

        $target = new \ReflectionClass(config('tosspayments.webhook.handler.controller'));
        $method = config('tosspayments.webhook.handler.method');
        return $target->newInstance()->$method($payload);
    }
}
