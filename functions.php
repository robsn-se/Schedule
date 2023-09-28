<?php

function addLog(mixed $data, string $fileName = "log"):void {
    file_put_contents(
        LOG_FOLDER ."/$fileName.log",
        "-- " . date("H:i:s d-m-Y") . "\n" . var_export($data, true) . "\n\n",
        FILE_APPEND
    );
}

function telegramAPIRequest(string $method, ?array $params = null): array {
    $response = file_get_contents(
        TELEGRAM_API_URL . TOKEN . "/" . $method . "?" . http_build_query($params)
    );
    addLog([
        "method" => $method,
        "params" => $params,
        "response" => $response
    ],
        "from_telegram"
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
    print_r(telegramAPIRequest("setWebhook", $params));
    exit();
}