<?php

namespace models;

use database\DB;
use SystemFailure;

class MainModel extends DB
{
    protected array $fields = [];

    protected ?int $id = null;

    protected string $tableName;

    public function __construct(int $id = null)
    {
        if ($id) {
            $this->id = $id;
            $this->get();
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    function camelToSnake(string $string)
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $string));
    }
    function snakeToCamel(string $string)
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $string))));
    }

    public function toCamelCase(string $string): string
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
            $fieldsData[$field] = $this->{"get" . ucfirst($camelField)}();
        }
        if ($this->id) {
            $this->update();
        }
        else{
            $this->id = $this->insert($this->tableName, $fieldsData);
        }
        return $this;
    }

    public function get(): self
    {
        $objectData = $this->selectOne($this->tableName, null, "`id` = {$this->id}");
        foreach ($objectData as $field => $value) {
            $camelField = $this->toCamelCase($field);
            if (!property_exists($this, $camelField)) {
                continue;
            }
            $this->{"set" . ucfirst($camelField)}($value);
        }
        return $this;
    }

    public static function getAll(): array {
        $array = self::selectAll();
        foreach ($array as $item) {

        }
    }
}