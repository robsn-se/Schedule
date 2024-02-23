<?php
require_once "core/functions.php";

$_ENV = parse_ini_file(".env");

spl_autoload_register(function($class)
{
    $namespace = str_replace("\\","/",__NAMESPACE__);
    $className = str_replace("\\","/",$class);
    $classFile = "./".(empty($namespace)?"":$namespace."/")."{$className}.php";
    include_once($classFile);
    if (method_exists($class, "init")) {
        $class::init();
    }
});