<?php

return [
    'api_key' => env('STANCER_API_KEY', 'your-api-key'),
    'endpoint' => env('STANCER_ENDPOINT', 'https://api.sandbox.stancer.com/v2'),
    'timeout' => env('STANCER_TIMEOUT', 60),
    'debug' => env('STANCER_DEBUG', false),
];