<?php
namespace models\bot;

use models\Storage;

class Action
{
    protected Context $context;

    protected Trigger $trigger;

    public function action(Storage $storage, string $storageVariable, string $messageText) {

    }
}