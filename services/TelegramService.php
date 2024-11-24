<?php

namespace services;

use bot\BotAPI;
use core\Log;
use exceptions\SystemFailure;

class TelegramService
{
    public static function hookEntrePoint(array $requestBody): bool {
        if (isset($requestBody["callback_query"])) {
            Log::add($requestBody, "callback_query");
        }
        elseif (isset($requestBody["message"])) {
            $params["chat_id"] = $requestBody["message"]["chat"]["id"];
            $request = mb_strtolower($requestBody["message"]["text"]);
            $entities = self::getEntities($requestBody["message"]);
            if (isset($entities["bot_command"])) {

                BotAPI::sendRequest("sendMessage", $params);
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