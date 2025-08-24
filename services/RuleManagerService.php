<?php

namespace services;

use bot\BotAPI;
use models\bot\Step;
use models\bot\triggers\ButtonTrigger;

/**
 *
 */
class RuleManagerService
{
    /**
     * @var string
     */
    private static string $folder;

    /**
     * @var string
     */
    private static string $stepFile;

    /**
     * @var string
     */
    private static string $triggerFile;

    /**
     * @var array
     */
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

    /**
     * @return array
     */
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

    /**
     * @param ButtonTrigger[] $buttonTriggers
     * @return array
     */
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

    /**
     * @param string $chatId
     * @param string $stepName
     * @return void
     * @throws \Exception
     */
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

    /**
     * @return array
     */
    public static function getFirstStep(): array {

    }
}