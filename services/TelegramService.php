<?php

namespace services;

use exceptions\SystemFailure;

class TelegramService
{
    public static function hookEntrePoint(array $requestBody): bool{
        if (isset($requestBody["callback_query"])) {

        }
        elseif (isset($requestBody["message"])) {

        }
        else{
            throw new SystemFailure("unexpected hook request");
        }
        return true;
    }
}