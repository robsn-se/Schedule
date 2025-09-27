<?php

namespace services;

use bot\BotAPI;
use core\Log;
use exceptions\SystemFailure;
use models\bot\Step;

class TelegramService
{
    public static function hookEntrePoint(array $requestBody): bool {
        if (isset($requestBody["callback_query"])) {
            Log::add($requestBody, "callback_query");
            $messageParams["chat_id"] = $requestBody["callback_query"]["message"]["chat"]["id"];
            RuleManagerService::addMessageParamsByStepName($messageParams, $requestBody["callback_query"]["data"]);
            BotAPI::sendRequest("sendMessage", $messageParams);
        }
        elseif (isset($requestBody["message"])) {
            $messageParams["chat_id"] = $requestBody["message"]["chat"]["id"];
            $entities = self::getEntities($requestBody["message"]);
            if (isset($entities["bot_command"])) {
                if (in_array("/start", $entities["bot_command"])) {
                    RuleManagerService::addMessageParamsByStepName($messageParams, "main_menu");
                    BotAPI::sendRequest("sendMessage", $messageParams);
                }
            }
            Log::add($requestBody, "message");
        }
        else{
            throw new SystemFailure("unexpected hook request");
        }
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