<?php

use controllers\PaymentController;
use controllers\UserController;
use core\Router;

Router::addRoute("GET", "/create_user", function () {
    echo UserController::createUser();
});

Router::addRoute("GET", "/create_payment", function () {
    echo PaymentController::createPayment();
});

Router::addRoute("GET", "/create_payment", function () {
    echo PaymentController::createPayment();
});