<?php

use core\Router;

require_once "core/init.php";

//use services\ProjectService;
//$project = ProjectService::createProject("Расписание занятий", 20, true);
//print_r($project);
include "routes.php";
try {
    Router::matchRoute();
}
catch (Exception $e) {
    echo $e->getMessage();
}
