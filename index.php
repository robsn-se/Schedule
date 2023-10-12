<?php
require_once "config.php";
require_once "functions.php";
require_once "schedule";

try {
    $phpInput = json_decode(file_get_contents("php://input"), true);

//    $schedule = json_decode(file_get_contents("schedule"), true);


    if (@$_GET["text"]) {
        $params["chat_id"] = ADMIN_ID;
        $params["text"] = @$_GET["text"];
        telegramAPIRequest("sendMessage", $params);
    }

    if (!isset($phpInput["update_id"])) {
        die();
    }



//    if (@$phpInput["message"]) {
//        $params["chat_id"] = $phpInput["message"]["chat"]["id"];
//        $params["text"] = 'I got phrase!!!: ' . mb_strtolower($phpInput["message"]["text"]);
////        $params["reply_markup"] => json_encode("inline_")
//        $params["reply_markup"] = createInlineButtons(OK_BUTTON);
//        telegramAPIRequest("sendMessage", $params);
//    }
}

catch (Throwable $e) {
    addLog(
        "{$e->getMessage()} | {$e->getFile()}({$e->getLine()}) \n{$e->getTraceAsString()} \n\n",
        "errors"
    );
}