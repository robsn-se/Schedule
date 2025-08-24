<?php

function env(string $envName, mixed $default = null): mixed {
    return $_ENV[$envName] ?? $default;
}

/**
* @throws Exception
*/
function config(string $configName): mixed {
    $configs = include "config.php";
    $configPath = explode(".", $configName);
    foreach ($configPath as $step) {
        if (@!$configs[$step]) {
            throw new Exception("Error, while reading config {$configName}");
        }
        $configs = $configs[$step];
    }
    return $configs;
}

/**
 * Recursively creates an object with nested objects from an array,
 * using setters if they exist for private properties.
 *
 * @param array $data The array representing the object structure.
 * @param string $className The root class name.
 * @return object The created object with nested objects.
 * @throws Exception If a class does not exist or a setter is missing.
 */
function createNestedObject(string $className, array $data, array $constructorParams = []): object
{
    if (!class_exists($className)) {

        if (!class_exists($className)){
            throw new Exception("Class $className does not exist.\n"); //. var_export(get_declared_classes(), true));
        }
    }

    $object = new $className(...$constructorParams);

    foreach ($data as $key => $value) {
        $setter = 'set' . ucfirst(\core\helperTrait::snakeToCamel($key));

        if (method_exists($object, $setter)) {
            if (is_array($value) && isAssoc($value)) {
                // If the value is an associative array, treat it as a single nested object.
                $nestedClassName = ucfirst(\core\helperTrait::snakeToCamel($key));
                $nestedObject = createNestedObject($nestedClassName, $value);
                $object->$setter($nestedObject);
            } elseif (is_array($value)) {
                // If the value is a list (plural), create a list of nested objects.
                $singularClassName = ucfirst(\core\helperTrait::snakeToCamel(rtrim($key, 's'))); // Convert plural to singular
                $nestedObjects = array_map(fn($item) => createNestedObject($singularClassName, $item), $value);
                $object->$setter($nestedObjects);
            } else {
                // Scalar value, set directly
                $object->$setter($value);
            }
        } else {
            throw new Exception("Setter $setter does not exist in class $className.");
        }
    }

    return $object;
}

/**
 * Checks if an array is associative.
 *
 * @param array $array
 * @return bool True if the array is associative, false otherwise.
 */
function isAssoc(array $array): bool
{
    return array_keys($array) !== range(0, count($array) - 1);
}







