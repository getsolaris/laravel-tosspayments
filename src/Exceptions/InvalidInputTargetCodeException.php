<?php

namespace Getsolaris\LaravelTossPayments\Exceptions;

class InvalidInputTargetCodeException extends \Exception
{
    protected $message = '입력하신 대상 코드가 올바르지 않습니다.';
}
