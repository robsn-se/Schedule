<?php

function env(string $envName): mixed {
    return $_ENV[$envName] ?? null;
}

/**
* @throws Exception
*/
function config(string $configName): mixed {
    $configs = include "config.php";
    $configPath = explode(".", $configName);
    foreach ($configPath as $step) {
        if (@!$configs[$step]) {
            throw new Exception("Error, while reading config {$configName}");
        }
        $configs = $configs[$step];
    }
    return $configs;
}