<?php

namespace core;

trait helperTrait {
    public static function camelToSnake(string $string): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $string));
    }
    public static function snakeToCamel(string $string)
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $string))));
    }

    public static function toCamelCase(string $string): string
    {
        return lcfirst(str_replace('_', '', ucwords($string, '_')));
    }

    public function fillArrayFromThis(array $schema): array
    {
        foreach ($schema as $snakeKey => $value) {
            $camelKey = self::snakeToCamel($snakeKey);
            if (property_exists($this, $camelKey)) {
                $schema[$snakeKey] = $this->$camelKey;
            }
        }

        return $schema;
    }


}