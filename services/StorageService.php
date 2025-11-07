<?php

use models\Storage;

class StorageService {
    private static string $folder;

    private static string $filePath;

    /**
     * @throws Exception
     */
    public static function init(): void {
        self::$folder = config("app.sender_storage_folder");
    }

    /**
     * @throws Exception
     */
    public function getStorage(int|string $ownerID): Storage {
        $rawStorageArray = self::getRawStorageArray($ownerID);
        /** @var Storage $storage  */
        $storage = createNestedObject(Storage::class, $rawStorageArray, [$ownerID]);
        return $storage ;
    }

    public static function getRawStorageArray(int|string $ownerID): array {
        self::$filePath = self::$folder . "/" . $ownerID;
        $senderStorage = file_get_contents(self::$filePath);
        return json_decode($senderStorage, JSON_OBJECT_AS_ARRAY);
    }
}