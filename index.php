<?php

require_once "config.php";
require_once "functions.php";

try {
    $phpInput = json_decode(file_get_contents("php://input"), true);

    $schedule = json_decode(file_get_contents("schedule"), true);

    foreach ($schedule as $key => $item) {
        $_GET = $schedule;
        $key = $item["title"];
        $alert = "!!!ВНИМАНИЕ!!!\nВ соответствии с распорядком дня,\nследующее мероприятие: " . $_GET[$key][$item]["description"] .
                "\nНачало в : " . $_GET[$key][$item]["from"] . "\nКонец в : " . $_GET[$key][$item]["to"] .
                "\nОбращаю внимание на соблюдение регламента служебного времени.\n!!!БЕЗ ОПОЗДАНИЙ!!!";
//        echo '<pre>', print_r($schedule, 1), '</pre>';
    }
    echo '<pre>', print_r($_GET[1], 1), '</pre>';

    $params["chat_id"] = ADMIN_ID;
    $params["text"] = $alert;
    telegramAPIRequest("sendMessage", $params);

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
} catch (Throwable $e) {
    addLog(
        "{$e->getMessage()} | {$e->getFile()}({$e->getLine()}) \n{$e->getTraceAsString()} \n\n",
        "errors"
    );
}