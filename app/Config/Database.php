<?php

namespace App\Config;

use PDO;

class Database
{

    const DB_HOST = "127.0.0.1";
    const DB_NAME = "veículo";
    const DB_USER = "Link";
    const DB_PASS = "TestandoBanco";

    /**
     * @var PDO
     */
    private PDO $stmt;

    /**
     * @return Database
     */
    public function __construct()
    {

        $this->stmt = new PDO(
            "mysql:host=".static::DB_HOST.";port=80;dbname=".static::DB_NAME,
            static::DB_USER,
            static::DB_PASS,
            [
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION,
                PDO::ERRMODE_WARNING
            ]
        );

        return $this;

    }

    /**
     * @return PDO
     */
    public function getPDO(): PDO
    {
        return $this->stmt;
    }

}