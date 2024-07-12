<?php

namespace core;

use Exception;

class Log
{

    const FILE_LOG_EXTENSION = ".log";

    private static string $dateTemplate;

    private static string $folder;

    private string $fileName;

    private static string $defaultFileName;


    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * @throws Exception
     */
    public static function init(): void{
        self::$folder = config("log.folder");
        self::$dateTemplate = config("log.date_template");
        self::$defaultFileName = config("log.default_file_name");
    }


    public static function add(mixed $data, ?string $fileName = null):void {
        file_put_contents(
            self::$folder ."/" . ($fileName ?? self::$defaultFileName) . self::FILE_LOG_EXTENSION,
            "-- " . date(self::$dateTemplate) . "\n" . var_export($data, true) . "\n\n",
            FILE_APPEND
        );
    }

    public function addLog(mixed $data):void {
        self::add($data, $this->fileName);
    }
}