<?php

namespace Getsolaris\LaravelTossPayments\Contracts;

interface AttributeInterface
{
    public function __construct();
    public function initializeUri(): static;
    public function createEndpoint(?string $endpoint): string;
}