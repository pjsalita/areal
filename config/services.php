<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect_uri' => env('GOOGLE_REDIRECT_URI'),
        'scopes' => [
            \Google_Service_Calendar::CALENDAR,
        ],
        'approval_prompt' => 'force',
        'access_type' => 'offline',
        'include_granted_scopes' => true,
        'default_token' => [
            "access_token" => "ya29.A0ARrdaM9-xMxfNXcUQNo7prbqQt_fnwljNcguZc5VQaT-yLykeARVx8bIDVX1ckaZUnv1rPJ6O7nWe6O7I_2qMVWTmyNLjnbng1-gKAZMOuffDPrOtNbRyz1uSbs9UTprJNQ9kHbml5wDVUg_v6Y3J86b6MUb",
            "expires_in" => 3599,
            "refresh_token" => "1//0dkMAGMBkAok8CgYIARAAGA0SNwF-L9IrOgcVpWRTGyAYgWJzXhYiU5QGgELZwTGLV2PqPLu7RJbgyx27IoOrugInNUTN57L_uNs",
            "scope" => "https://www.googleapis.com/auth/calendar",
            "token_type" => "Bearer",
            "created" => 1650984039,
        ]
    ],
];
