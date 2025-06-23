<?php

function autoloader($trida)
{
    if (!file_exists(__DIR__ . '/../../public/entities/' . $trida . '.php'))
        return false;
    require(__DIR__ . '/../../public/entities/' . $trida . '.php');
}

spl_autoload_register('autoloader');