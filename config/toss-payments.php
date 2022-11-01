<?php

return [
    'endpoint' => 'https://api.tosspayments.com',
    'version' => 'v1',
    'client_key' => env('TOSS_PAYMENTS_CLIENT_KEY'),
    'secret_key' => env('TOSS_PAYMENTS_SECRET_KEY'),
    'content_type' => 'application/json',
    'accept' => 'application/json',
];
