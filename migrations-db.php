<?php declare(strict_types=1);
return [
    'dbname' => getenv('MYSQL_DATABASE'),
    'user' => getenv('MYSQL_USER'),
    'password' => getenv('MYSQL_PASSWORD'),
    'host' => getenv('MYSQL_HOST'),
    'port' => getenv('MYSQL_PORT'),
    'driver' => 'pdo_mysql',
];