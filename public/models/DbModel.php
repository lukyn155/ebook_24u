<?php

// Statická třída sloužící pro nastavení databázového připojení
class DbModel {

    private static $entityManager;

    public static function setConnection($entityManager) {
        self::$entityManager = $entityManager;
    }
    
    public static function getConnection() {
        return self::$entityManager;
    }
}
