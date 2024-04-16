<?php

namespace models;

class Payment extends MainModel
{
    private string $date;

    private int $projectId;

    private int $userId;

    private int $priceId;

    private string $details;


    protected static string $tableName = "payments";

    protected array $fields = [
        "id",
        "date",
        "project_id",
        "user_id",
        "price_id",
        "details"
    ];
    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
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
     * @return int
     */
    public function getPriceId(): int
    {
        return $this->priceId;
    }

    /**
     * @param int $priceId
     */
    public function setPriceId(int $priceId): void
    {
        $this->priceId = $priceId;
    }

    /**
     * @return array
     */
    public function getDetails(): array
    {
        return json_decode($this->details, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param string $details
     */
    public function setDetails(string $details): void
    {
        $this->details = $details;
    }
}