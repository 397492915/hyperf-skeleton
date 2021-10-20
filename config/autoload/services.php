<?php
$registry = [
    'protocol' => 'consul',
    'address' => env('CONSUL_ADDRESS', 'localhost'),
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
