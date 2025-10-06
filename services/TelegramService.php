<?php

namespace services;

use bot\BotAPI;
use core\Log;
use exceptions\SystemFailure;
use models\bot\Step;

class TelegramService
{
    private static string $storageFolder;
    /**
     * @throws \Exception
     */
    public static function init(): void {
        self::$storageFolder = config("app.sender_storage_folder");
    }

    public static function hookEntrePoint(array $requestBody): bool {
        if (isset($requestBody["callback_query"])) {
            Log::add($requestBody, "callback_query");
            $senderID = $requestBody["callback_query"]["from"]["id"];
            $messageParams["chat_id"] = $requestBody["callback_query"]["message"]["chat"]["id"];
            $stepName = $requestBody["callback_query"]["data"];
        }
        elseif (isset($requestBody["message"])) {
            $senderID = $requestBody["message"]["from"]["id"];
            $messageParams["chat_id"] = $requestBody["message"]["chat"]["id"];
            $entities = self::getEntities($requestBody["message"]);
            if (isset($entities["bot_command"])) {
                if (in_array("/start", $entities["bot_command"])) {
                   $stepName = "main_menu";
                }
            }
            Log::add($requestBody, "message");
        }
        else{
            throw new SystemFailure("unexpected hook request");
        }

        $senderStorageFile = self::$storageFolder . "/" . $senderID;
        if (file_exists( $senderStorageFile)) {
            $senderStorage = file_get_contents($senderStorageFile);
        }
        else {
            $storageData = json_encode(["last_step" => $stepName]);
            file_put_contents($senderStorageFile, $storageData);
        }

        RuleManagerService::addMessageParamsByStepName($messageParams, $stepName);
        BotAPI::sendRequest("sendMessage", $messageParams);

        return true;
    }

    public static function getEntities(array $message): array {
        $entities = [];
        if (
            trim($message["text"])
            && isset($message["entities"])
            && is_array($message["entities"])
        ) {
            foreach ($message["entities"] as $entity) {
                if (isset($entity["type"])) {
                    $command = substr($message["text"], $entity["offset"], $entity["length"]);
                    if (!isset($entities[$entity["type"]])) {
                        $entities[$entity["type"]] = [0 => $command];
                    }
                    else {
                        $entities[$entity["type"]][] = $command;
                    }
                }

            }
        }
        return $entities;
    }
}