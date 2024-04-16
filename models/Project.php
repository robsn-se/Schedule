<?php

namespace models;

class Project extends MainModel
{
    protected string $name;

    private int $userId;

    private bool $active = true;

    private string $delay_time;



    protected static string $tableName = "projects";

    protected array $fields = [
        "id",
        "name",
        "user_id",
        "delay_time"
    ];

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return bool
     */
    public function getActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return string
     */
    public function getDelayTime(): string
    {
        return $this->delay_time;
    }

    /**
     * @param string $delay_time
     */
    public function setDelayTime(string $delay_time): void
    {
        $this->delay_time = self::dateToTimeStamp($delay_time);
    }


}
