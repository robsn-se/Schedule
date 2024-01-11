<?php

namespace database;

use Exception;
use PDO;

class DB
{
    protected PDO $connect;

    private string $dsn;

    private string $user;

    private string $password;



    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->dsn = config("database.connect")
            . ":host=" . config("database.host")
            . ";dbname=" .config("database.name") . ";";
        $this->user = config("database.user");
        $this->password = config("database.password");
        $this->connect = new PDO($this->dsn, $this->user, $this->password);
    }

    protected function createSQLSet(array $fields, string $delimiter = ""): string {
        $fieldsString = "";
        foreach ($fields as $field => $value) {
            $fieldsString .=  "`{$field}` = {$value} {$delimiter}";
        }
        return substr($fieldsString, 0, -(strlen($delimiter) + 1));
    }

    protected function  getTableFields(string $tableName) {
//        $sth = $this->connect->prepare("SHOW COLUMNS FROM ?");
//        $sth->execute([$tableName]);
        $sth = $this->connect->query("SHOW COLUMNS FROM $tableName");
        $fields = [];
        foreach ($sth as $field) {
            $fields[] = $field["Field"];
        }
        return $fields;
    }
}