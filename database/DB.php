<?php

namespace database;

use Exception;
use PDO;
use PDOStatement;
use SystemFailure;

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
        $this->connect->exec("SET names utf8");
    }

    protected function createSQLSet(array $fields, string $delimiter = ","): string {
        $fieldsString = "";
        foreach ($fields as $field) {
            $fieldsString .=  "{$field} = ? {$delimiter}";
        }
        return substr($fieldsString, 0, -(strlen($delimiter) + 1));
    }

    public function insert(string $tableName, array $fieldsData): int {
        $stmt = $this->connect->prepare("INSERT INTO {$tableName} SET {$this->createSQLSet(array_keys($fieldsData))}");
        if (!$stmt->execute(array_values($fieldsData)) || !$id = $this->connect->lastInsertId()) {
            throw new SystemFailure("Error while inserting to `{$tableName}`", $stmt->errorInfo());
        }
        return (int) $id;
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

    protected function select(string $tableName, ?array $fields = null, ?string $where = null): PDOStatement {
        $stringFields = $fields ? implode(",", $fields) : "*";
        $where = $where ?? 1;
        $stmt = $this->connect->prepare("SELECT {$stringFields} FROM {$tableName} WHERE {$where}");
        $stmt->execute();
        return $stmt;
    }

    protected function selectOne(string $tableName, ?array $fields = null, ?string $where = null): array {
        return $this->select($tableName, $fields, $where)->fetch();
    }
}















