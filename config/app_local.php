<?php
declare(strict_types=1);

// Environment-driven local config: all values flow from container env,
// so the same image can be deployed anywhere (Dokploy sets these).
return [
    'debug' => filter_var(env('DEBUG', false), FILTER_VALIDATE_BOOLEAN),

    'Security' => [
        'salt' => env('SECURITY_SALT', '0e6f386a0a64f12b97ae5277e33beb27dcbf89f9f95506a40908c16b3b600096'),
    ],

    'Datasources' => [
        'default' => [
            'host' => 'localhost',
            'url' => env('DATABASE_URL', 'sqlite://127.0.0.1/tmp/app.sqlite'),
        ],
    ],
];
