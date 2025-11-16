<?php

namespace models;

use core\helperTrait;
use Exception;

class Storage {

    use helperTrait;

    private int|string $ownerID;

    private array $variables;

    private ?string $lastStep;

    private ?string $nextStep;

    private static string $folder;

    private static string $filePath;

    /**
     * @throws Exception
     */
    public static function init(): void {
        self::$folder = config("app.sender_storage_folder");
    }

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
     * @return string|null
     */
    public function getLastStep(): ?string
    {
        return $this->lastStep;
    }

    /**
     * @param string|null $lastStep
     */
    public function setLastStep(?string $lastStep): void
    {
        $this->lastStep = $lastStep;
    }

    /**
     * @return string|null
     */
    public function getNextStep(): ?string
    {
        return $this->nextStep;
    }

    /**
     * @param string|null $nextStep
     */
    public function setNextStep(?string $nextStep): void
    {
        $this->nextStep = $nextStep;
    }

    /**
     * @throws Exception
     */
    public static function load(int|string $ownerID): self {
        $rawStorageArray = self::getRawStorageArray($ownerID);
        /** @var Storage $storage  */
        $storage = createNestedObject(Storage::class, $rawStorageArray, [$ownerID]);
        return $storage ;
    }

    private static function generateRawStorageArray(): array {

        return [
            "last_step" => null,
            "variables"=> [],
            "next_step" => null,
        ];
    }

    private static function getRawStorageArray(int|string $ownerID): array {
        self::$filePath = self::$folder . "/" . $ownerID;
        if (file_exists(self::$filePath)) {
            $storageArray = file_get_contents(self::$filePath);
            return json_decode($storageArray, JSON_OBJECT_AS_ARRAY);
        }
        else {
            return self::generateRawStorageArray();
        }
    }

    public function save(): void {
        file_put_contents(self::$filePath, json_encode($this->fillArrayFromThis(self::generateRawStorageArray()), JSON_UNESCAPED_UNICODE));
    }

}