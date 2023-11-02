<?php

require_once 'DatabaseManager.php';

final class DatabaseConfig extends DatabaseManager
{
    const HOST = "localhost";
    const USER = "root";
    const PASS = "";
    const DATABASE = "practicedb_products";

    public function __construct()
    {
        $this->setConnectionInfo(
            self::HOST,
            self::USER,
            self::PASS,
            self::DATABASE
        )->connect();
        return $this;
    }
}
