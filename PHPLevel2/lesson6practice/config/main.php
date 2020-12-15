<?php

return [
    'db' => [
        'dsn' => 'mysql:dbname=dz;host=127.0.0.1',
        'user' => 'root',
        'pwd' => '1531',
    ],
    'templates' => __DIR__ . '/../templates',
    'routing' => [
        'login' => 'auth/index',
        'logout' => 'auth/logout',
        'basket' => 'user/basket',
        'catalog\/([0-9]+)\/([0-9]+)' => 'catalog/good',
        'catalog\/([0-9]+)' => 'catalog/category',
        'catalog' => 'catalog/index',
        'pages\/(.*)' => 'pages/index',
        '(\w+)\/(\w+)' => '<controller>/<action>',
        '(\w+)([\/.]*)' => '<controller>/index',
        '^$' => 'index/index',
        '(.*)' => 'index/error',
    ],
];