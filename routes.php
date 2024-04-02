<?php

use controllers\EventController;
use controllers\PaymentController;
use controllers\UserController;
use core\Router;

Router::addRoute("POST", "/create_user", function () {
    echo UserController::createUser();
});

Router::addRoute("PUT", "/update_user/{id}", function ($id) {
    echo UserController::updateUser($id);
});

Router::addRoute("GET", "/get_all_users", function () {
    echo UserController::getAllUsers();
});


Router::addRoute("PUT", "/update_event/{id}", function ($id) {
    echo EventController::updateEvent($id);
});

Router::addRoute("POST", "/create_event", function () {
    echo EventController::createEvent();
});

Router::addRoute("GET", "/get_all_events", function () {
    echo EventController::getAllEvents();
});

//Router::addRoute("GET", "/create_payment", function () {
//    echo PaymentController::createPayment();
//});
//
//Router::addRoute("GET", "/create_payment", function () {
//    echo PaymentController::createPayment();
//});