<?php

namespace services;

use models\User;
use exceptions\SystemFailure;

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

    /**
     * @throws SystemFailure
     */
    public static function updateUser
    (
        int $id,
        array $fields
    ): User {
        $user = new User($id);
        foreach ($fields as $key => $value) {
            $camelKey = $user->snakeToCamel($key);
            $user->{"set" . ucfirst($camelKey)}($value);
        }
        $user->save();
        return $user->get();
    }

    /**
     * @return User[]
     */
    public static function getAllUsers(): array {
        return User::getAll();
    }
}