<?php

use App\Core\Env;

Env::load(dirname(__DIR__) . '/.env');

return [
    'app' => [
        'env' => Env::get('APP_ENV', 'local'),
        'url' => Env::get('APP_URL', 'http://localhost:8000'),
    ],
    'jwt' => [
        'secret' => Env::get('JWT_SECRET', ''),
        'cookie_name' => Env::get('JWT_COOKIE_NAME', 'app_token'),
    ],
];
