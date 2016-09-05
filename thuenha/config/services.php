<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'facebook' => [
    'client_id' => '1741814122735646',
    'client_secret' => '9e86f491f64530262840941b2566dd6c',
    'redirect' => 'http://homestead.app/callback/facebook',
    ],
    'google' => [
    'client_id' => '112924022247-toaotejeiksuu4uqs2nn7q9agthksjc5.apps.googleusercontent.com',
    'client_secret' => 'EImGIFlsmp1M4Mq4WWj1R-Ll',
    'redirect' => 'http://homestead.app/callback/google',
    ],

];
