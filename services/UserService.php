<?php

namespace services;

use models\User;

class UserService
{
    public static function createUser
    (
        string $telegramId,
        string $telegramUsername,
        string $roleLevel = User::ROLE_LEVELS[0]
    ): User {
        $user = new User();
        $user->setTelegramId($telegramId);
        $user->setTelegramUsername($telegramUsername);
        $user->setRoleLevel($roleLevel);
        $user->save();
        return $user;
    }

    public static function updateUser
    (
        int $id,
        array $fields
    ): User {
        $user = new User($id);

        return $user;
    }

    /**
     * @return User[]
     */
    public static function getAllUsers(): array {
        return User::getAll();
    }
}