<?php
use App\TurboConfig;

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
        'domain' => TurboConfig::get('MAILGUN_DOMAIN'),
        'secret' => TurboConfig::get('MAILGUN_SECRET'),
        'endpoint' => TurboConfig::get('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => TurboConfig::get('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => TurboConfig::get('AWS_ACCESS_KEY_ID'),
        'secret' => TurboConfig::get('AWS_SECRET_ACCESS_KEY'),
        'region' => TurboConfig::get('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

];
