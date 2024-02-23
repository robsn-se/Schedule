<?php

namespace models;

class User extends MainModel
{
    public const MEMBER_ROLE_LEVEL = "member";

    public const ADMIN_ROLE_LEVEL = "admin";

    public const SUPER_ADMIN_ROLE_LEVEL = "super_admin";

    public const ROLE_LEVELS = [
        self::MEMBER_ROLE_LEVEL,
        self::ADMIN_ROLE_LEVEL,
        self::SUPER_ADMIN_ROLE_LEVEL
    ];

    protected static string $tableName = "users";

    protected array $fields = [
        "id",
        "telegram_id",
        "telegram_username",
        "role_level"
    ];


    protected string $telegramId;

    protected string $telegramUsername;

    protected string $roleLevel;

    public function __construct(?int $id = null) {
        parent::__construct($id);
    }

    public function getTelegramId(): string
    {
        return $this->telegramId;
    }

    public function setTelegramId(string $telegramId): void
    {
        $this->telegramId = $telegramId;
    }

    /**
     * @return string
     */
    public function getTelegramUsername(): string
    {
        return $this->telegramUsername;
    }

    /**
     * @param string $telegramUsername
     */
    public function setTelegramUsername(string $telegramUsername): void
    {
        $this->telegramUsername = $telegramUsername;
    }

    /**
     * @return string
     */
    public function getRoleLevel(): string
    {
        return $this->roleLevel;
    }

    /**
     * @param string $roleLevel
     */
    public function setRoleLevel(string $roleLevel): void
    {
        $this->roleLevel = $roleLevel;
    }

}