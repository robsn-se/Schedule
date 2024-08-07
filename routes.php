<?php

use controllers\EventController;
use controllers\MemberController;
use controllers\PaymentController;
use controllers\PriceController;
use controllers\ProjectController;
use controllers\TelegramController;
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

Router::addRoute("DELETE", "/delete_user/{id}", function ($id) {
    echo UserController::deleteUserById($id);
});


//###


Router::addRoute("PUT", "/update_event/{id}", function ($id) {
    echo EventController::updateEvent($id);
});

Router::addRoute("POST", "/create_event", function () {
    echo EventController::createEvent();
});

Router::addRoute("GET", "/get_all_events", function () {
    echo EventController::getAllEvents();
});


//###


Router::addRoute("PUT", "/update_project/{id}", function ($id) {
    echo ProjectController::updateProject($id);
});

Router::addRoute("POST", "/create_project", function () {
    echo ProjectController::createProject();
});

Router::addRoute("GET", "/get_all_projects", function () {
    echo ProjectController::getAllProjects();
});


//###


Router::addRoute("PUT", "/update_price/{id}", function ($id) {
    echo PriceController::updatePrice($id);
});

Router::addRoute("POST", "/create_price", function () {
    echo PriceController::createPrice();
});

Router::addRoute("GET", "/get_all_prices", function () {
    echo PriceController::getAllPrices();
});


//###


Router::addRoute("PUT", "/update_payment/{id}", function ($id) {
    echo PaymentController::updatePayment($id);
});

Router::addRoute("POST", "/create_payment", function () {
    echo PaymentController::createPayment();
});

Router::addRoute("GET", "/get_all_payments", function () {
    echo PaymentController::getAllPayments();
});


//###


Router::addRoute("PUT", "/update_member/{id}", function ($id) {
    echo MemberController::updateMember($id);
});

Router::addRoute("POST", "/create_member", function () {
    echo MemberController::createMember();
});

Router::addRoute("GET", "/get_all_members", function () {
    echo MemberController::getAllMembers();
});



Router::addRoute("DELETE", "/delete_event/{id}", function ($id) {
    echo EventController::deleteEventById($id);
});
Router::addRoute("DELETE", "/delete_member/{id}", function ($id) {
    echo MemberController::deleteMemberById($id);
});
Router::addRoute("DELETE", "/delete_payment/{id}", function ($id) {
    echo PaymentController::deletePaymentById($id);
});
Router::addRoute("DELETE", "/delete_price/{id}", function ($id) {
    echo PriceController::deletePriceById($id);
});
Router::addRoute("DELETE", "/delete_project/{id}", function ($id) {
    echo ProjectController::deleteProjectById($id);
});
Router::addRoute("DELETE", "/delete_user/{id}", function ($id) {
    echo UserController::deleteUserById($id);
});



Router::addRoute("GET", "/set_telegram_hook/{set}", function ($set) {
    echo TelegramController::setHook((int) $set);
});
Router::addRoute("POST", \bot\BotAPI::API_ENTRE_POINT, function () {
    echo TelegramController::hookEntrePoint();
});



//Router::addRoute("GET", "/create_payment", function () {
//    echo PaymentController::createPayment();
//});
//
//Router::addRoute("GET", "/create_payment", function () {
//    echo PaymentController::createPayment();
//});