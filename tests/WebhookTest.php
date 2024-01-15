<?php

namespace Getsolaris\LaravelTossPayments\tests;

use PHPUnit\Framework\TestCase;

class WebhookTest extends TestCase
{
    public function testWebhook(): void
    {
        $payload = $this->getData();

        $this->assertIsArray($payload);
        $this->assertArrayHasKey('eventType', $payload);
        $this->assertArrayHasKey('createdAt', $payload);
        $this->assertArrayHasKey('data', $payload);
        $this->assertIsArray($payload['data']);
    }

    private function getData(): array
    {
        $payload = '{
          "eventType": "PAYMENT_STATUS_CHANGED",
          "createdAt": "2022-01-01T00:00:00.000000",
          "data": {}
        }';

        return json_decode($payload, true);
    }
}
