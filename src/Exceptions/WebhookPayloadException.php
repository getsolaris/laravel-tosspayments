<?php

namespace Getsolaris\LaravelTossPayments\Exceptions;

class WebhookPayloadException extends \Exception
{
    protected $message = 'Webhook 의 Payload 정보가 올바르지 않습니다.';
}
