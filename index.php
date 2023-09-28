<?php
require_once "config.php";
require_once "functions.php";

try {
    $phpInput = json_decode(file_get_contents("php://input"), true);

    if (!isset($phpInput["update_id"])) {
        die();
    }

    if (@$phpInput["message"]) {
        $request = mb_strtolower($phpInput["message"]["text"]);
        $params["text"] = $request;
        if (!$params["text"]) {
            $params["text"] = "ok";
        }
        telegramAPIRequest("sendMessage", $params);
    }
}

catch (Throwable $e) {
    addLog(
        "{$e->getMessage()} | {$e->getFile()}({$e->getLine()}) \n{$e->getTraceAsString()} \n\n",
        "errors"
    );
}