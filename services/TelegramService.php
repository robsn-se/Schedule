<?php

namespace services;

use core\Log;
use exceptions\SystemFailure;

class TelegramService
{
    public static function hookEntrePoint(array $requestBody): bool{
        if (isset($requestBody["callback_query"])) {
            Log::add($requestBody, "callback_query");
        }
        elseif (isset($requestBody["message"])) {
            $params["chat_id"] = $requestBody["message"]["chat"]["id"];
            $request = mb_strtolower($requestBody["message"]["text"]);
            Log::add($requestBody, "message");
        }
        else{
            throw new SystemFailure("unexpected hook request");
        }
        return true;
    }
}