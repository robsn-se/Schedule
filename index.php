<?php
require_once "core/init.php";

use services\UserService;
//use \core\App;

//$app = new App();

//print_r($app->getEnv());
$user = UserService::createUser(8555,"kfbvhkbfk");
print_r($user);
