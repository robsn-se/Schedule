<?php

use controllers\UserController;
use core\Router;

Router::addRoute("GET", "/create_user", function () {
    echo UserController::createUser();
});
