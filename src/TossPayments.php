<?php

namespace Getsolaris\LaravelTossPayments;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class TossPayments
{
    protected $attribute;

    protected $client;

    protected string $endpoint;

    protected string $version;

    protected string $url;

    protected string $clientKey;

    protected string $secretKey;

    protected array $headers = [];

    public function __construct($attribute)
    {
        $this->setAttribute($attribute)
            ->initializeApiUrl()
            ->initializeKeys()
            ->initializeHeaders()
            ->initializeHttp();
    }

    /**
     * @return $this
     */
    public function setAttribute($attribute): static
    {
        $this->attribute = $attribute;

        return $this;
    }

    public static function for($attribute): static
    {
        return new static(new $attribute);
    }

    /**
     * @return TossPayments
     */
    public function __call($name, $arguments)
    {
        return $this->attribute->{$name}(...$arguments);
    }

    /**
     * @return $this
     */
    protected function initializeApiUrl(): static
    {
        $this->endpoint = config('tosspayments.endpoint');
        $this->version = config('tosspayments.version');
        $this->url = $this->endpoint.'/'.$this->version;

        return $this;
    }

    /**
     * @return $this
     */
    protected function initializeKeys(): static
    {
        $this->clientKey = config('tosspayments.client_key');
        $this->secretKey = config('tosspayments.secret_key');

        return $this;
    }

    /**
     * @return $this
     */
    protected function initializeHeaders(): static
    {
        $this->headers = [
            'Authorization' => 'Basic '.base64_encode($this->secretKey.':'),
            'Content-Type' => 'application/json',
        ];

        return $this;
    }

    /**
     * @return $this
     */
    protected function initializeHttp(): static
    {
        $this->client = Http::withHeaders($this->headers);

        return $this;
    }

    public function start(string $value, string $prefix = '/'): string
    {
        return Str::start($value, $prefix);
    }

    /**
     * @return $this
     */
    protected function testCode(string $code): static
    {
        $this->client = Http::withHeaders($this->headers + ['TossPayments-Test-Code' => $code]);

        return $this;
    }
}
