<?php
require_once "config.php";
require_once "functions.php";

try {
    $phpInput = json_decode(file_get_contents("php://input"), true);

    if (!isset($phpInput["update_id"])) {
        die();
    }

//    if (@$phpInput["message"]) {
//        $params["chat_id"] = $phpInput["message"]["chat"]["id"];
//        $request = mb_strtolower($phpInput["message"]["text"]);
//        $params["text"] = getAnswerByRules($request);
//        if (!$params["text"]) {
//            $params["text"] = "{$phpInput["message"]["from"]["first_name"]}, я не понимаю тебя!\nЧто значит, " . quotePhrase($request) . "?\n\nДобавить слово в словарь?";
//        }
//        telegramAPIRequest("sendMessage", $params);
//    }

    if (@$phpInput["message"]) {
        $params["chat_id"] = $phpInput["message"]["chat"]["id"];
        $params["text"] = 'I got phrase: ' . mb_strtolower($phpInput["message"]["text"]);
        telegramAPIRequest("sendMessage", $params);
    }
}

catch (Throwable $e) {
    addLog(
        "{$e->getMessage()} | {$e->getFile()}({$e->getLine()}) \n{$e->getTraceAsString()} \n\n",
        "errors"
    );
}