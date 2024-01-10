<?php

namespace services;

use models\User;

class UserService
{
    public static function createUser
    (
        int $telegramId,
        string $telegramUsername,
        string $roleLevel = User::ROLE_LEVELS[0]
    ): User {
        $user = new User();
        $user->setTelegramId($telegramId);
        $user->setTelegramUsername($telegramUsername);
        $user->setRoleLevel($roleLevel);
        return $user;
    }
}