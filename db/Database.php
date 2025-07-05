<?php

class Database
{
    private static $instance = null;
    private $connection;

    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'wahelp';

    private function __construct()
    {
        $this->connection = new mysqli(
            $this->host,
            $this->username,
            $this->password,
            $this->dbname
        );

        if ($this->connection->connect_error) {
            die("Ошибка подключения: " . $this->connection->connect_error);
        }

        $this->connection->set_charset("utf8mb4");
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
