<?php

namespace Getsolaris\LaravelTossPayments;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class TossPayments
{
    /**
     * @var string
     */
    protected $attribute;

    /**
     * @var
     */
    protected $client;

    /**
     * @var string
     */
    protected string $endpoint;

    /**
     * @var string
     */
    protected string $version;

    /**
     * @var string
     */
    protected string $url;

    /**
     * @var string
     */
    protected string $clientKey;

    /**
     * @var string
     */
    protected string $secretKey;

    /**
     * @var array
     */
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
     * @param $attribute
     * @return $this
     */
    public function setAttribute($attribute): static
    {
        $this->attribute = $attribute;

        return $this;
    }

    /**
     * @param $attribute
     * @return static
     */
    public static function for($attribute): static
    {
        return new static(new $attribute);
    }

    /**
     * @param $name
     * @param $arguments
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

    /**
     * @param  string  $value
     * @param  string  $prefix
     * @return string
     */
    public function start(string $value, string $prefix = '/'): string
    {
        return Str::start($value, $prefix);
    }

    /**
     * @param  string  $code
     * @return $this
     */
    protected function testCode(string $code): static
    {
        $this->client = Http::withHeaders($this->headers + ['TossPayments-Test-Code' => $code]);

        return $this;
    }
}
