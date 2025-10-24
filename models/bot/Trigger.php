<?php
namespace models\bot;

class Trigger
{
    protected string $uid;

    protected Action $action;

    protected string $dataKey;

    protected ?string $storageVariable = null;


    public function getStorageVariable(): ?string
    {
        return $this->storageVariable;
    }

    public function setStorageVariable(?string $storageVariable): void
    {
        $this->storageVariable = $storageVariable;
    }

    /**
     * @return Action
     */
    public function getAction(): Action
    {
        return $this->action;
    }

    /**
     * @param Action $action
     */
    public function setAction(Action $action): void
    {
        $this->action = $action;
    }
}