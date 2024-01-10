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

function createInlineButtons(array $buttons, int $columnCount = 1): string {
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

function setHook(bool $unset = false): void {
    $params["url"] = $unset ?
        $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"]
        : "";
    echo "<pre>";
    print_r(telegramAPIRequest("setWebhook", $params));
    exit();
}

function buildAlert(array $event): string
{
    return "!!!ВНИМАНИЕ!!!\nВ соответствии с распорядком дня,\nследующее мероприятие: " .
        $event["description"] .
        "\nНачало в " . $event["from"] . "\nКонец в " . $event["to"] .
        "\nОбращаю внимание на соблюдение регламента служебного времени.\n!!!БЕЗ ОПОЗДАНИЙ!!!";
}

function sendAlertBySchedule(): void {
    $schedule = json_decode(file_get_contents("schedule"), true);
//    $params["chat_id"] = ADMIN_ID;
    $today = date('H:i', (time() + DELAY_TIME));
    foreach ($schedule as $eventID => $item) {
        if ($today == $item["from"]) {
            $params["text"] = buildAlert($item);
//            $params["reply_markup"] = createInlineButtons(CONFIRM_SCHEDULE_BUTTON);
            $fileUserNikNameTMP = explode("\n", file_get_contents("user_nicknames_tmp.json"));
            foreach ($fileUserNikNameTMP as $userName) {
                $params["chat_id"] = trim($userName);
                telegramAPIRequest("sendMessage", $params);
            }
        }
    }
}

function confirmOrder(array $phpInput) {
    $nowTime = date('H:i:s');
    $params["message_id"] = $phpInput["callback_query"]["message"]["message_id"];
    $params["chat_id"] = $phpInput["callback_query"]["message"]["chat"]["id"];
    $params["username"] = $phpInput["callback_query"]["message"]["chat"]["username"];
    $params["text"] =
        "{$params["username"]}, ✅ ПРИНЯТО! ({$nowTime}) \n\n" . $phpInput["callback_query"]["message"]["text"];
    addLog($phpInput, "callback_query");
    telegramAPIRequest("editMessageText", $params);
}

function userRegistration(array $message) {
    $userNicknames = json_decode(file_get_contents("user_nicknames_tmp"));
    $user = null;
    foreach ($userNicknames as $userData) {
        if ($userData["username"] === $message["from"]["username"]) {
            $user = $message["from"];


            break;
        }
    }
    if (!$user) {
        return false;
    }
}