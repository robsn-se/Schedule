<?php

namespace models;

class BotAPI
{
    private static string $token;

    private static string $apiUrl;
    /**
     * @throws \Exception
     */
    public static function init(): void {
        self::$token = config("telegram.token");
        self::$apiUrl = config("telegram.api_url");
    }

    function sendRequest(string $method, ?array $params = null): array {
        $response = file_get_contents(
            self::$apiUrl . self::$token . "/" . $method . "?" . http_build_query($params)
        );
        if ($response) {
            $response = json_decode($response, true);
        }
        return $response;
    }

    function setHook(bool $unset = false): void {
        $params["url"] = $unset ?
            $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"]
            : "";
        echo "<pre>";
        print_r(self::sendRequest("setWebhook", $params));
        exit();
    }
}