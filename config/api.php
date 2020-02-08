<?php

return [
    'auth' => [
        'token_expiration' => env('TOKEN_EXPIRATION', '+5 Minutes'), #token expiration time in days
        'key'=>env('APP_KEY'),
    ],
    'api_secret_key' => env('API_SECRET_KEY'),
    'users_api' => [
        // Authorization type Config
        'auth' => [
            'key' => 't', // t = type
            'mobile_no' => 'm', // If uid is mobile_no
            'id' => 'd', // If uid is doctor_id
        ],
        'date_format' => [
            'input' => 'Y-m-d',
            'output' => 'd/m/Y',
            'internal' => 'Y-m-d'
        ],
        'time_format' => [
            'input' => 'h:i A',
            'output' => 'h:i A',
            'internal' => 'H:i:s'
        ],
        'date_time_format' => [
            'input' => 'd/m/Y h:i A',
            'output' => 'd/m/Y Y h:i A',
            'internal' => 'Y-m-d H:i:s'
        ],
        'timezone' => [
            'user' => env('DEFAULT_TIMEZONE', 'Asia/Kolkata'),
            'login' => [
                'token_expiration' => 30, #token expiration time in days
            ],
        ],
        'booking_apis' => [
            'max_months' => 3, #number of months to add in start date if end date is not present
        ],
    ],
];
