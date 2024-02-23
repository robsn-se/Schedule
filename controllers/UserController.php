<?php
namespace controllers;

use core\Request;
use services\UserService;

class UserController
{
    public static function createUser(): string {
        $bodyArray = Request::getBodyArray();
        $user = UserService::createUser($bodyArray["telegram_id"], $bodyArray["telegram_user_name"]);
        return "<pre>" . print_r($user, true);
    }
    public static function updateUser(int $id): string {
        $bodyArray = Request::getBodyArray();
        $user = UserService::updateUser($id, $bodyArray);
        return "<pre>" . print_r($user, true);
    }

    public static function getAllUsers(): string {

    }
}
