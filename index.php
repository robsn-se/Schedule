<?php
require_once "config.php";
require_once "functions.php";
//echo strtotime("06:30", 0) + 3*60*60;
echo $today = date('H:i', (time() - DELAY_TIME));
try {
    $phpInput = json_decode(file_get_contents("php://input"), true);
//    $today = date("H:i");
//    echo $today;
    $schedule = json_decode(file_get_contents("schedule"), true);
    $eventID = null;
//    $message = $schedule[$_GET["key"]]["from"];
//foreach ($schedule as $eventID => $item) {
////    if ($today === $item["from"]) {
//        $alert = "!!!ВНИМАНИЕ!!!\nВ соответствии с распорядком дня,\nследующее мероприятие: " .
//            $item["description"] .
//            "\nНачало в " . $item["from"] . "\nКонец в " . $item["to"] .
//            "\nОбращаю внимание на соблюдение регламента служебного времени.\n!!!БЕЗ ОПОЗДАНИЙ!!!";
////    }
//}
//    echo $alert;

//    $alert = "!!!ВНИМАНИЕ!!!\nВ соответствии с распорядком дня,\nследующее мероприятие: " .
//        $eventID[$item]["description"] .
//        "\nНачало в : " . $eventID[$item]["from"] . "\nКонец в : " . $eventID[$item]["to"] .
//        "\nОбращаю внимание на соблюдение регламента служебного времени.\n!!!БЕЗ ОПОЗДАНИЙ!!!";


    $alert = "!!!ВНИМАНИЕ!!!\nВ соответствии с распорядком дня,\nследующее мероприятие: " . $schedule[$_GET["key"]]
            ["description"] .
                "\nНачало в : " . $schedule[$_GET["key"]]["from"] . "\nКонец в : " . $schedule[$_GET["key"]]["to"] .
                "\nОбращаю внимание на соблюдение регламента служебного времени.\n!!!БЕЗ ОПОЗДАНИЙ!!!";

//        $messageTime = date('H:i', (time() - 60 * 30));
//        echo $messageTime;
//        echo strtotime("06:30", 0);
//            if ($message) {
////                $time;
//             } else{
//                echo "событие ещё не пришло";
//             }
//    echo '<pre>', print_r($schedule, 1), '</pre>';

    $params["chat_id"] = ADMIN_ID;
//    $params["text"] = $alert;
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