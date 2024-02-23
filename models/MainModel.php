<?php

namespace models;

use database\DB;
use exceptions\SystemFailure;

class MainModel extends DB
{
    protected array $fields = [];

    protected ?int $id = null;

    protected static string $tableName;

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

    public function setId(int $id): void
    {
        $this->id = $id;
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

    /**
     * @throws SystemFailure
     */
    public function save(): self
    {
        $this->fields = self::getTableFields(static::$tableName);
        $fieldsData = [];
        foreach ($this->fields as $field) {
            $camelField = $this->toCamelCase($field);
            if (!property_exists($this, $camelField)) {
                continue;
            }
            $fieldsData[$field] = $this->{"get" . ucfirst($camelField)}();
        }
        if ($this->id) {
            $this->update(static::$tableName, $fieldsData, "`id` = {$this->id}");
        }
        else{
            $this->id = $this->insert(static::$tableName, $fieldsData);
        }
        return $this;
    }

    public function get(): self
    {
        $objectData = self::selectOne(static::$tableName, null, "`id` = {$this->id}");
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
        $objects = [];
        $array = self::selectAll(static::$tableName);
        foreach ($array as $item) {
            $object = new static();
            foreach ($item as $field => $value) {
                $camelField = $object->toCamelCase($field);
                if (!property_exists($object, $camelField)) {
                    continue;
                }
                $object->{"set" . ucfirst($camelField)}($value);
            }
            $objects[] = $object;
        }
        return $objects;
    }

    public function toArray(): array
    {
        $array = [];
        foreach ($this->fields as $field) {
            $camelField = $this->toCamelCase($field);
            if (!property_exists($this, $camelField)) {
                continue;
            }
            $array[$field] = $this->{"get" . ucfirst($camelField)}();
        }
        return $array;
    }
}