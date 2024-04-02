<?php

namespace models;

class Event extends MainModel
{
    private string $name;

    private string $description;

    private int $projectId;

    private string $fromTime;

    private string $toTime;

    private bool $active = true;

    private string $weekDays;

    protected static string $tableName = "events";

    protected array $fields = [
        "id",
        "name",
        "description",
        "project_id",
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
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getProjectId(): int
    {
        return $this->projectId;
    }

    /**
     * @param int $projectId
     */
    public function setProjectId(int $projectId): void
    {
        $this->projectId = $projectId;
    }

    /**
     * @return string
     */
    public function getFromTime(): string
    {
        return $this->fromTime;
    }

    /**
     * @param string $fromTime
     */
    public function setFromTime(string $fromTime): void
    {
        $this->fromTime = self::dateToTimeStamp($fromTime);
    }

    /**
     * @return string
     */
    public function getToTime(): string
    {
        return $this->toTime;
    }

    /**
     * @param string $toTime
     */
    public function setToTime(string $toTime): void
    {
        $this->toTime = self::dateToTimeStamp($toTime);
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
    public function getWeekDays(): string
    {
        return $this->weekDays;
    }

    /**
     * @param string $weekDays
     */
    public function setWeekDays(string $weekDays): void
    {
        $this->weekDays = $weekDays;
    }
}