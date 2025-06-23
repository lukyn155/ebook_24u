<?php
// Nastavení základního kódování
mb_internal_encoding('UTF-8');
// Nastavení základní časové zóny
date_default_timezone_set("Europe/Prague");

// Vytvoření autoload funkce, která automaticky načte všechny třídy kontrolérů a modelů
function autoloadFunction(string $class) {
    if (preg_match('/Controller$/', $class)) {
        require(__DIR__ . "/controllers/" . $class . ".php");
    } elseif (preg_match('/Model$/', $class)) {
        require(__DIR__ . "/models/" . $class . ".php");
    }
}

// Nastavení vlastní autoload funkce
spl_autoload_register("autoloadFunction");

// Vyžadování scriptu s nastavením databáze
require_once __DIR__ . '/../config/bootstrap.php';

// Předání nastavení databáze pro použití kdekoli v projektu
DbModel::setConnection($entityManager);

// Vytvoření instance router controlleru a zprocesování na základě zadaného URI
$router = new RouterController();
$router->process(array($_SERVER['REQUEST_URI']));
$router->getView();
