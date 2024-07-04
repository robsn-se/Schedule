<?php
namespace controllers;

use core\Request;
use services\UserService;

class UserController
{
    public static function createUser(): string {
        $bodyArray = Request::getBodyArray();
        $user = UserService::createUser($bodyArray["telegram_id"], $bodyArray["telegram_username"]);
        return "<pre>" . print_r($user->toArray(), true);
    }

    public static function updateUser(int $id): string {
        $bodyArray = Request::getBodyArray();
        $user = UserService::updateUser($id, $bodyArray);
        return "<pre>" . print_r($user->toArray(), true);
    }

    public static function getAllUsers(): string {
        $users = UserService::getAllUsers();
        foreach ($users as $key => $user) {
            $users[$key] = $user->toArray();
        }
        return "<pre>" . print_r($users, true);
    }

    public static function deleteUserById(int $id): string {
        UserService::deleteUserById($id);
        return "User {$id} has been deleted successfully";
    }
}