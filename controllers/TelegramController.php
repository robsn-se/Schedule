<?php

namespace controllers;

use bot\BotAPI;
use core\Log;
use services\TelegramService;

class TelegramController
{
    public static function setHook(int $set): string {
        return "<pre>" . print_r(BotAPI::setHook($set), true) . "</pre>";
    }

    public static function hookEntrePoint(): bool {
        $requestBody = json_decode(file_get_contents("php://input"), true);
        try {
            return TelegramService::hookEntrePoint($requestBody);
        }
        catch (\Throwable $e) {
            Log::add([
                "message"=> $e->getMessage(),
                "code"=> $e->getCode(),
                "trace"=> $e->getTraceAsString(),
            ], "fatal_error");
        }
    }
}
