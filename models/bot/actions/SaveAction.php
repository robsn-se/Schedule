<?php

namespace models\bot\actions;

use core\Log;
use models\bot\Action;

class SaveAction extends Action
{
    public function action(string $storageVariable, mixed $storageVariableValue) {
        Log::add([$storageVariable => $storageVariableValue], "storage");
    }
}