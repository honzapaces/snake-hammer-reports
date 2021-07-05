<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;

/** @var \Nette\DI\Container $container */
$container = (require_once __DIR__.'/../App/bootstrap.php')->build();
// replace with mechanism to retrieve EntityManager in your app
$entityManager = $container->getByType(\Doctrine\ORM\EntityManager::class);

return ConsoleRunner::createHelperSet($entityManager);