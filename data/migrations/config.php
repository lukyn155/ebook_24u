<?php

return [
    'table_storage' => [
        'table_name' => 'doctrine_migration_versions',
    ],

    'migrations_paths' => [
        'Migrations' => __DIR__,  // kde se budou ukládat migrace
    ],

    'all_or_nothing' => true,        // buď všechny SQL příkazy projdou, nebo žádný
    'check_database_platform' => true,
];

