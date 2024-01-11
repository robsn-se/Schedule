<?php
return[
    "database" => [
        "connect" => env("DB_CONNECT", "mysql"),
        "host" => env("DB_HOST"),
        "user" => env("DB_USER"),
        "password" => env("DB_PASSWORD"),
        "name" => env("DB_NAME"),
    ],

    "telegram" => [
        "api_url" => "https://api.telegram.org/bot",
    ],

    "logs" => [
        "folder" => "logs"
    ],

];
//
//const OK_BUTTON = [
//    [
//        "text" => "ok",
//        "callback_data" => "ok"
//    ]
//];
//
//const DELAY_TIME = 10 * 60;
//
//const CONFIRM_SCHEDULE_BUTTON_CALLBACK_DATA = "confirm_order";
//
//const CONFIRM_SCHEDULE_BUTTON = [
//    [
//        "text" => 'Принял',
//        "callback_data" => CONFIRM_SCHEDULE_BUTTON_CALLBACK_DATA,
//    ],
//];