<?php

namespace core;

class Request
{
    protected static ?string $body;

    protected static array $bodyArray = [];

    public static function init(): void {
        self::$body = file_get_contents("php://input") ?? null;
        if (self::$body) {
            self::$bodyArray = json_decode(self::$body, true);
        }
    }

    public static function getBodyArray(): array {
        return self::$bodyArray;
    }
}