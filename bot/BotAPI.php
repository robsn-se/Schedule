<?php

namespace bot;

use core\Log;

class BotAPI
{
    const SERVER_PROJECT_FOLDER = "/schedule";

    const API_ENTRE_POINT = "/telegram_hook_entre_point";

    const SERVER_ENTRE_POINT = self::SERVER_PROJECT_FOLDER . self::API_ENTRE_POINT; // потому что у нас на сервере несколько ботов

    const LOG_NAME = "bot_API";

    private static string $token;

    private static string $apiUrl;

    private static Log $log;

    /**
     * @throws \Exception
     */
    public static function init(): void {
        self::$token = config("telegram.token");
        self::$apiUrl = config("telegram.api_url");
        self::$log = new Log(self::LOG_NAME);
    }

    public static function sendRequest(string $method, ?array $params = null): array {
        $response = file_get_contents(
            self::$apiUrl . self::$token . "/" . $method . "?" . http_build_query($params)
        );
        self::$log->addLog([
            "method" => $method,
            "params" => $params,
            "response" => $response
        ]);
        if ($response) {
            $response = json_decode($response, true);
        }
        return $response;
    }

    public static function setHook(bool $unset = false): array {
        $params["url"] = $unset ?
            $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"] . self::SERVER_ENTRE_POINT
            : "";
        $response = self::sendRequest("setWebhook", $params);
        $response["url"] = $params["url"];
        return $response;
    }

    public static function createInlineButtons(array $buttons, int $columnCount = 1): string {
        $rowCounter = 0; // укладка ряда
        $columnCounter = 0; // укладка в колонну
        $result = []; // массив кнопок
        foreach ($buttons as $button) {
            if (!isset($result[$rowCounter])) {
                $result[$rowCounter] = [];
            }
            $result[$rowCounter][] = $button;
            $columnCounter++;
            if($columnCounter % $columnCount) {
                continue;
            }
            $rowCounter++;
        }
        return json_encode(["inline_keyboard" => $result], JSON_UNESCAPED_UNICODE);
    }
}