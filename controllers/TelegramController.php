<?php

namespace controllers;

use bot\BotAPI;
use services\TelegramService;

class TelegramController
{
    public static function setHook(int $set): string {
        return "<pre>" . print_r(BotAPI::setHook($set), true) . "</pre>";
    }

    public static function hookEntrePoint(): bool {
        $requestBody = json_decode(file_get_contents("php://input"), true);
        return TelegramService::hookEntrePoint($requestBody);
    }
}
