<?php

namespace models;

use database\DB;

class MainModel extends DB
{
    protected array $fields = [];

    protected ?int $id = null;

    protected string $tableName;

    public function getId(): ?int
    {
        return $this->id;
    }

    protected function toCamelCase(string $string): string
    {
        return lcfirst(str_replace('_', '', ucwords($string, '_')));
    }
    public function save(): self
    {
        $this->fields = $this->getTableFields($this->tableName);
        $fieldsData = [];
        foreach ($this->fields as $field) {
            $camelField = $this->toCamelCase($field);
            if (!property_exists($this, $camelField)) {
                continue;
            }
            $fieldsData[$field] = $this->{$camelField};
        }
        $this->id = $this->insert($this->tableName, $fieldsData);
        return $this;
    }
}