<?php

namespace bot;

class BotAPI
{
    const SERVER_PROJECT_FOLDER = "/schedule";

    const API_ENTRE_POINT = "/telegram_hook_entre_point";

    const SERVER_ENTRE_POINT = self::SERVER_PROJECT_FOLDER . self::API_ENTRE_POINT;

    private static string $token;

    private static string $apiUrl;

    /**
     * @throws \Exception
     */
    public static function init(): void {
        self::$token = config("telegram.token");
        self::$apiUrl = config("telegram.api_url");
    }

    public static function sendRequest(string $method, ?array $params = null): array {
        $response = file_get_contents(
            self::$apiUrl . self::$token . "/" . $method . "?" . http_build_query($params)
        );
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
}