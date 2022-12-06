<?php

namespace Getsolaris\LaravelTossPayments\Controllers;

use Getsolaris\LaravelTossPayments\Exceptions\WebhookPayloadException;

class WebhookController
{
    /**
     * @throws WebhookPayloadException
     */
    public function __invoke()
    {
        $payload = json_decode(request()->getContent(), true);

        if (! $payload) {
            throw new WebhookPayloadException();
        }

        $eventType = $payload['eventType'];
        $createdAt = $payload['createdAt'];
        $data = $payload['data'];

        return $payload;
    }
}
