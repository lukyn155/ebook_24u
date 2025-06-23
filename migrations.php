<?php

use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\DependencyFactory;

require_once __DIR__ . '/config/bootstrap.php';

$config = new PhpFile(__DIR__ . '/data/migrations/config.php');

return DependencyFactory::fromEntityManager(
    $config,
    new ExistingEntityManager($entityManager)
);
