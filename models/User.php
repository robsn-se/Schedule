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

    protected string $tableName = "users";

    protected array $fields = [
        "id",
        "telegram_id",
        "telegram_username",
        "role_level"
    ];


    /** @var int  */
    private int $id;

    private int $telegramId;

    private string $telegramUsername;

    private string $roleLevel;

//    public function __construct
//    (
//        int $telegramId,
//        string $telegramUsername,
//        string $roleLevel = self::ROLE_LEVELS[0])
//    {
//        $this->id = rand(1,10000);
//        $this->telegramId = $telegramId;
//        $this->telegramUsername = $telegramUsername;
//        $this->roleLevel = $roleLevel;
//    }

    /** @return int */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTelegramId(): int
    {
        return $this->telegramId;
    }

    public function setTelegramId(int $telegramId): void
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