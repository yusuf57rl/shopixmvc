<?php


namespace App\Core;

use PDO;
use PDOException;

class DatabaseConnection
{
    public function __construct(
        private $host = "localhost:3336",
        private $username = "root",
        private $password = "nexus123",
        private $database = "shopixmvc",
    )
    {
    }

    public function getConnection(): PDO
    {
        $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database, $this->username, $this->password);

        return $this->conn;
    }

    public function closeConnection(PDO $connection): void
    {
        unset($connection);
    }
}