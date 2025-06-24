#!/usr/bin/env php
<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner as OrmConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;
use Doctrine\Migrations\Tools\Console\ConsoleRunner as MigrationsConsoleRunner;
use Symfony\Component\Console\Application;

require_once __DIR__ . '/bootstrap.php';          // $entityManager
$dependencyFactory = require __DIR__ . '/../migrations.php'; // DependencyFactory

// 1) Vytvoříme Symfony Console aplikaci se všemi ORM příkazy
$cli = OrmConsoleRunner::createApplication(
    new SingleManagerProvider($entityManager)
);

// 2) Přidáme _všechny_ migrační příkazy najednou
MigrationsConsoleRunner::addCommands($cli, $dependencyFactory);

// 3) Spustíme CLI
$cli->run();