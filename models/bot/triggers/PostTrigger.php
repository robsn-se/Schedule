<?php
namespace models\bot\triggers;

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

}