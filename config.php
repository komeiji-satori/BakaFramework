<?php
define('Config', json_encode([
    'OUTPUT' => 'json',
    'DB_TYPE' => 'MySQL',
    'CACHE_TYPE' => 'redis',
    'MySQL' => [
        'host' => '127.0.0.1',
        'port' => 3306,
        'dbname' => 'satori',
        'charset' => 'UTF8MB4',
        'user' => 'root',
        'pass' => 'satori',
    ],
    // 'SQLite' => [
    //     'name' => '/path/to/sqlite.db',
    // ],
    'Redis' => [
        'host' => '127.0.0.1',
        'port' => 6379,
        'auth' => null,
    ],
    'Memcache' => [
        'host' => '127.0.0.1',
        'port' => 11211,
    ],
]));
