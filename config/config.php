<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    'api_token' => env('UBICUAL_API_TOKEN'),
    'from' => env('UBICUAL_FROM', 'Ubicual'),
    'base_url' => env('UBICUAL_BASE_URL', 'https://api.ubicual.com/api/v1/sms/send'),
];
