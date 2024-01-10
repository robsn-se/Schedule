<?php

namespace database;

use PDO;

class DB
{
    protected PDO $connect;

    public function __construct()
    {
        $this->connect = new PDO("mysql:host=;dbname=;");
    }
}