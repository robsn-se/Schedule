<?php

namespace services;

use bot\BotAPI;
use models\bot\Step;
use models\bot\Trigger\ButtonTrigger;

class RuleManagerService
{
    private static string $folder;

    private static string $stepFile;

    private static string $triggerFile;

    private static array $steps;

    /**
     * @throws \Exception
     */
    public static function init(): void {
        self::$folder = config("rules.folder");
        self::$stepFile = self::$folder . "/" . config("rules.step_file");
        self::$triggerFile = self::$folder . "/" . config("rules.trigger_file");
        self::$steps = self::getSteps();
    }

    public static function getSteps(): array {
        return json_decode(file_get_contents(self::$stepFile), true);
    }

    /**
     * @throws \Exception
     */
    public static function getStep(string $name): Step {
        $step = createNestedObject(Step::class, self::$steps[$name], [$name]);
        /** @var Step $step */
        return $step;
    }

    public static function getMessageButtons(array $buttonTriggers): array {
        $buttonArray = [];
        foreach ($buttonTriggers as $buttonTrigger) {
            $buttonArray[] = [
                "text" => $buttonTrigger["name"],
                "callback_data" => $buttonTrigger["action"]
            ];
        }
        return $buttonArray;
    }

    public static function getMessageParamsByStepName(string $chatId, string $stepName) {
        $step = self::getStep($stepName);
        $params = [
            "chat_id" => $chatId,
        ];
        if (isset($step["text"])) {
            $params["text"] = $step["text"];
        }
        if (isset($step["button_triggers"])) {
            $params["reply_markup"] = BotAPI::createInlineButtons(self::getMessageButtons($step["button_triggers"]), 2);
        }
    }

    public static function getFirstStep(): array {

    }
}