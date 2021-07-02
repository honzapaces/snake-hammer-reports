<?php declare(strict_types=1);
include_once __DIR__ . '/../vendor/autoload.php';

return (new App\Model\Bootstrap\Bootstrapper(!empty(getenv("DEV")),
    __DIR__ . '/../config/config.core.neon',
    __DIR__ . '/../tmp',
    __DIR__ . '/../log',
    'jn.bielik@gmail.com'));