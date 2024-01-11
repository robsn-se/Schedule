<?php

namespace models;

use database\DB;

class MainModel extends DB
{
    protected array $fields = [];

    protected string $tableName;


    public function save(): self
    {
        $this->fields = $this->getTableFields($this->tableName);

        foreach ($this->fields as $field) {
            print_r($this->fields);

        }
        return $this;
    }
}