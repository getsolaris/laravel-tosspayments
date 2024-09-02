<?php

namespace Getsolaris\LaravelTossPayments\Handlers;

use Getsolaris\LaravelTossPayments\Exceptions\WebhookPayloadException;
use Illuminate\Http\Request;

class TossPaymentsWebhookHandler
{
    /**
     * @throws WebhookPayloadException
     * @throws \ReflectionException
     * @throws \JsonException
     */
    public function __invoke(Request $request)
    {
        $payload = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

        if (! $payload) {
            throw new WebhookPayloadException;
        }

        $target = new \ReflectionClass(config('tosspayments.webhook.handler.controller'));
        $method = config('tosspayments.webhook.handler.method');

        return $target->newInstance()->$method($payload);
    }
}
