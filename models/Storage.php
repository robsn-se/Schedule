<?php

namespace models;

class Storage {

    private int|string $ownerID;

    private array $variables;

    private string $lastName;

    private string $nextStep;


    public function __construct(int|string $ownerID) {
        $this->ownerID = $ownerID;
    }

    /**
     * @return array
     */
    public function getVariables(): array
    {
        return $this->variables;
    }

    /**
     * @param array $variables
     */
    public function setVariables(array $variables): void
    {
        $this->variables = $variables;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getNextStep(): string
    {
        return $this->nextStep;
    }

    /**
     * @param string $nextStep
     */
    public function setNextStep(string $nextStep): void
    {
        $this->nextStep = $nextStep;
    }

}