<?php

class DatabaseConnection
{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbname = "stdinfo";

    public function connect()
    {
        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname;
            $db = new PDO($dsn, $this->user, $this->password);
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $db;
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
            return null;
        }
    }
}
