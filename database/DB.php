<?php

namespace database;

use Exception;
use mysql_xdevapi\Statement;
use PDO;
use PDOStatement;
use SystemFailure;

class DB
{
    protected static PDO $connect;

    private static string $dsn;

    private static string $user;

    private static string $password;



    public static function init(): void {
        self::$dsn = config("database.connect")
            . ":host=" . config("database.host")
            . ";dbname=" .config("database.name") . ";";
        self::$user = config("database.user");
        self::$password = config("database.password");
        self::$connect = new PDO(self::$dsn, self::$user, self::$password);
        self::$connect->exec("SET names utf8");
    }

    protected function createSQLSet(array $fields, string $delimiter = ","): string {
        $fieldsString = "";
        foreach ($fields as $field) {
            $fieldsString .=  "{$field} = ? {$delimiter}";
        }
        return substr($fieldsString, 0, -(strlen($delimiter) + 1));
    }

    public function insert(string $tableName, array $fieldsData): int {
        $stmt = self::$connect->prepare("INSERT INTO {$tableName} SET {$this->createSQLSet(array_keys($fieldsData))}");
        if (!$stmt->execute(array_values($fieldsData)) || !$id = self::$connect->lastInsertId()) {
            throw new SystemFailure("Error while inserting to `{$tableName}`", $stmt->errorInfo());
        }
        return (int) $id;
    }

    public function update(int $id, array $fieldsData, string $tableName): int {
        $stmt = self::$connect->prepare("UPDATE {$tableName} SET {$this->createSQLSet(array_keys($fieldsData))}");
        if (!$stmt->execute(array_values($fieldsData)) || $stmt->rowCount()) {
            throw new SystemFailure("Error while updating to `{$tableName}`", $stmt->errorInfo());
        }
        return $id;
    }

    protected function  getTableFields(string $tableName) {
//        $sth = $this->connect->prepare("SHOW COLUMNS FROM ?");
//        $sth->execute([$tableName]);
        $sth = self::$connect->query("SHOW COLUMNS FROM $tableName");
        $fields = [];
        foreach ($sth as $field) {
            $fields[] = $field["Field"];
        }
        return $fields;
    }

    protected function select(string $tableName, ?array $fields = null, ?string $where = null): PDOStatement {
        $stringFields = $fields ? implode(",", $fields) : "*";
        $where = $where ?? 1;
        $stmt = self::$connect->prepare("SELECT {$stringFields} FROM {$tableName} WHERE {$where}");
        $stmt->execute();
        return $stmt;
    }

    protected function selectOne(string $tableName, ?array $fields = null, ?string $where = null): array {
        return $this->select($tableName, $fields, $where)->fetch();
    }

    public function selectAll(string $tableName, ?array $fields = null): array {
        return $this->select($tableName, $fields)->fetchAll();
    }
}