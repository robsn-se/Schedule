<?php
namespace models\bot\Trigger;

use models\bot\Action;
use models\bot\Trigger;

class PostTrigger extends Trigger
{

    protected string $messageText;

    protected Action $action;


    /**
     * @return string
     */
    public function getMessageText(): string
    {
        return $this->messageText;
    }

    /**
     * @param string $messageText
     */
    public function setMessageText(string $messageText): void
    {
        $this->messageText = $messageText;
    }

    /**
     * @return Action
     */
    public function getAction(): Action
    {
        return $this->action;
    }

    /**
     * @param Action $action
     */
    public function setAction(Action $action): void
    {
        $this->action = $action;
    }

}