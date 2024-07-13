<?php
use App\TurboConfig;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Broadcaster
    |--------------------------------------------------------------------------
    |
    | This option controls the default broadcaster that will be used by the
    | framework when an event needs to be broadcast. You may set this to
    | any of the connections defined in the "connections" array below.
    |
    | Supported: "pusher", "ably", "redis", "log", "null"
    |
    */

    'default' => TurboConfig::get('BROADCAST_DRIVER', 'null'),

    /*
    |--------------------------------------------------------------------------
    | Broadcast Connections
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the broadcast connections that will be used
    | to broadcast events to other systems or over websockets. Samples of
    | each available type of connection are provided inside this array.
    |
    */

    'connections' => [

        'pusher' => [
            'driver' => 'pusher',
            'key' => TurboConfig::get('PUSHER_APP_KEY'),
            'secret' => TurboConfig::get('PUSHER_APP_SECRET'),
            'app_id' => TurboConfig::get('PUSHER_APP_ID'),
            'options' => [
                'cluster' => TurboConfig::get('PUSHER_APP_CLUSTER'),
                'host' => TurboConfig::get('PUSHER_HOST') ?: 'api-'.TurboConfig::get('PUSHER_APP_CLUSTER', 'mt1').'.pusher.com',
                'port' => TurboConfig::get('PUSHER_PORT', 443),
                'scheme' => TurboConfig::get('PUSHER_SCHEME', 'https'),
                'encrypted' => true,
                'useTLS' => TurboConfig::get('PUSHER_SCHEME', 'https') === 'https',
            ],
            'client_options' => [
                // Guzzle client options: https://docs.guzzlephp.org/en/stable/request-options.html
            ],
        ],

        'ably' => [
            'driver' => 'ably',
            'key' => TurboConfig::get('ABLY_KEY'),
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => 'default',
        ],

        'log' => [
            'driver' => 'log',
        ],

        'null' => [
            'driver' => 'null',
        ],

    ],

];
