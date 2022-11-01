<?php

namespace Getsolaris\LaravelTossPayments\Exceptions;

class LargeLimitException extends \Exception
{
    protected $message = 'limit 가 10000을 초과하였습니다.';
}
