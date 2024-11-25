<?php

return [
    'rocket' => [
        'status' => env('ROCKET_STATUS', true),
        'developer_mail' => env('ROCKET_DEVELOPER_MAIL', null),
        'exception_channel_local' => env('ROCKET_LOCAL_CHANNEL', 'developer-headshot'),
        'exception_channel_test' => env('ROCKET_TEST_CHANNEL', 'test-errors'),
        'exception_channel_prod' => env('ROCKET_PROD_CHANNEL', 'production-errorla-mucadele'),
    ]
];
