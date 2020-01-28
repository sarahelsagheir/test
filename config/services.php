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
        'client_id' => '538886013255-2079sn5n6lqnga26skcttgcts0lllhr6.apps.googleusercontent.com',
        'client_secret' => 'ZRCvDagB8IiokhukH2lO3HqJ',
        'redirect' => 'http://localhost:8000/login/facebook/callback',
    ],
    'facebook' => [

        'client_id' => '1045480779150951',

        'client_secret' => '12405a9ef3472efa7546c2cd028d27a8',

        'redirect' => 'http://localhost:8000/auth/google/callback',

    ],
    'stripe' => [
        
        'model' => App\User::class,

        'secret' => 'sk_test_l3aH1wRbcweGiMge6vDejT7C00Fhjm0Z7E',
        'version' => '2019-02-19',

    ],

    

];
