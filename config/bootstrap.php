<?php

// bootstrap.php
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require_once __DIR__ . "/../vendor/autoload.php";

$config = ORMSetup::createAttributeMetadataConfiguration(
        paths: array(__DIR__ . "/../public/entities"),
        isDevMode: true,
);

// configuring the database connection
$connection = DriverManager::getConnection([
    'driver' => 'pdo_pgsql',
    'host' => '127.0.0.1',
    'port' => 5432,
    'user' => 'jirka',
    'password' => 'Jirka',
    'dbname' => 'ebooks_24u'
        ], $config);

// obtaining the entity manager
$entityManager = new EntityManager($connection, $config);
