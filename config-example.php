<?php

return [
    'db' => [
        'connection' => getenv('DB_CONNECTION') ?: 'mysql',
        'host' => getenv('DB_HOST') ?: 'mysqlserver',
        'database' => getenv('DB_DATABASE') ?: 'dev_pessoaslocal',
        'username' => getenv('DB_USERNAME') ?: 'dev',
        'password' => getenv('DB_PASSWORD') ?: 'developer',
        'port' => getenv('DB_PORT') ?: 3306,
    ],
];
