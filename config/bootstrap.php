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
            'driver' => 'pdo_sqlite',
            'path' => __DIR__ . '/../data/database.sqlite',
                ], $config);

// obtaining the entity manager
$entityManager = new EntityManager($connection, $config);
