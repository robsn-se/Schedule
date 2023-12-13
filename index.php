<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require_once "config.php";
require_once "functions.php";

try {
    $params = [];
    if (isset($_GET["hook"])) {
        setHook((bool) $_GET["hook"]);
    }
    if (isset($_GET["code"]) && $_GET["code"] == CRON_CODE) {
        sendAlertBySchedule();
    }
    $phpInput = json_decode(file_get_contents("php://input"), true);

    if (isset($phpInput["callback_query"])) {
//        switch ($phpInput["callback_query"]["data"]) {
//            case CONFIRM_SCHEDULE_BUTTON_CALLBACK_DATA:
                confirmOrder($phpInput);
//                break;
//        }
    }

} catch (Throwable $e) {
    $error = "{$e->getMessage()} | {$e->getFile()}({$e->getLine()}) \n{$e->getTraceAsString()} \n\n";
    echo $error;
    addLog(
        $error,
        "errors"
    );
}