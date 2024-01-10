<?php

namespace models;

class Event
{
    private int $id;

    private string $name;

    private string $description;

    private int $projectId;

    private int $fromTime;

    private int $toTime;

    private int $active;

    private string $weekDays;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

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
     * @return int
     */
    public function getFromTime(): int
    {
        return $this->fromTime;
    }

    /**
     * @param int $fromTime
     */
    public function setFromTime(int $fromTime): void
    {
        $this->fromTime = $fromTime;
    }

    /**
     * @return int
     */
    public function getToTime(): int
    {
        return $this->toTime;
    }

    /**
     * @param int $toTime
     */
    public function setToTime(int $toTime): void
    {
        $this->toTime = $toTime;
    }

    /**
     * @return int
     */
    public function getActive(): int
    {
        return $this->active;
    }

    /**
     * @param int $active
     */
    public function setActive(int $active): void
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