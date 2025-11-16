<?php

namespace services;

use bot\BotAPI;
use core\Log;
use exceptions\SystemFailure;
use models\bot\Step;
use models\Storage;


class TelegramService
{
    private static string $storageFolder;
    /**
     * @throws \Exception
     */
    public static function init(): void {
        self::$storageFolder = config("app.sender_storage_folder");
    }

    /**
     * @throws SystemFailure
     * @throws \Exception
     */
    public static function hookEntrePoint(array $requestBody): bool {
        $stepName = null;
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
        else {
            throw new SystemFailure("unexpected hook request");
        }

        $storage = Storage::load($senderID);
        $lastStep = $storage->getLastStep();
        if (!empty($lastStep)) {
            $lastStep = RuleManagerService::getStep($lastStep);
            $postTriggers = $lastStep->getPostTriggers();
            Log::add($postTriggers, "post_trigger");
            if (!empty($postTriggers)) {
                foreach ($postTriggers as $postTrigger) {
                    Log::add($postTrigger, "post_triggers");
                    $storageVariable = $postTrigger->getStorageVariable();
                    $postTrigger->getAction()->action($storageVariable, $requestBody["message"]["text"]);
                }
            }
        }

        if (!is_null($stepName)) {
            $storage->setLastStep($stepName);
        }

        $storage->save();


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