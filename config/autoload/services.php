<?php
$registry = [
    'protocol' => 'consul',
    'address' => env('CONSUL_ADDRESS', 'localhost'),
];

$options = [
    'connect_timeout' => 5.0,
    'recv_timeout' => 5.0,
    'settings' => [
        'open_eof_split' => true,
        'package_eof' => "\r\n",
    ],
    'retry_count' => 2,
    'retry_interval' => 100,
    'pool' => [
        'min_connections' => 1,
        'max_connections' => 32,
        'connect_timeout' => 10.0,
        'wait_timeout' => 3.0,
        'heartbeat' => -1,
        'max_idle_time' => 60.0,
    ],
];

return [
    'enable' => [
        'discovery' => true,
        'register' => true,
    ],
    'providers' => [],
    'consumers' => [
        [
            'name' => 'CalculatorService',
            'registry' => $registry,
        ],
        [
            'name' => 'TestService',
            'registry' => $registry,
        ]

    ],
    'drivers' => [
        'consul' => [
            'uri' => env('CONSUL_ADDRESS', 'localhost'),
            'token' => '',
        ],
    ],
];
