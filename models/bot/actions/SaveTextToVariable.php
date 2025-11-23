<?php

namespace models\bot\actions;

use models\bot\Action;
use models\Storage;

class SaveTextToVariable extends Action
{
    public function action(Storage $storage, string $storageVariable, string $messageText) {
        $storage->setVariables(array_merge($storage->getVariables(), [$storageVariable => $messageText]));
        $storage->save();
    }
}