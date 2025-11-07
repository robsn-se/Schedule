<?php

namespace services;

use bot\BotAPI;
use core\Log;
use models\bot\Step;
use models\bot\triggers\ButtonTrigger;
use models\Storage;

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

    public static function runActions() {


    }

    /**
     * @param ButtonTrigger[] $buttonTriggers
     * @return array
     */
    public static function getMessageButtons(array $buttonTriggers): array {
        $buttonArray = [];
        foreach ($buttonTriggers as $buttonTrigger) {
            $buttonArray[] = [
                "text" => $buttonTrigger->getName(),
                "callback_data" => $buttonTrigger->getValue(),
            ];
        }
        return $buttonArray;
    }

    /**
     * @param array $messageParams
     * @param string $stepName
     * @return void
     * @throws \Exception
     */
    public static function addMessageParamsByStepName(array &$messageParams, string $stepName) {
        $step = self::getStep($stepName);
        $messageText = $step->getText();
        $messageParams["text"] = empty($messageText) ? "Step: $stepName" : $messageText;

        $buttonTriggers = $step->getButtonTriggers();

        if (!empty($buttonTriggers)) {
            $messageParams["reply_markup"] = BotAPI::createInlineButtons(self::getMessageButtons($buttonTriggers), 2);
        }
    }

    /**
     * @return array
     */
    public static function getFirstStep(): array {

    }

}