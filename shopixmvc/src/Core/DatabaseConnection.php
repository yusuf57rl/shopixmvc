<?php


namespace App\Core;

use PDO;
use PDOException;

class DatabaseConnection
{
    public function __construct(
        private $host = "127.0.0.1",
        private $port = 3306,
        private $username = "root",
        private $password = "nexus123",
        private $database = "shopixmvc",
        private $testing = false,
    )
    {
        if ($this->testing = true) {
            $this->host = "127.0.0.1";
            $this->database = "shopixmvc_test";
            $this->username = "root";
            $this->password = "nexus123";
            $this->port = 3206;
        }
    }

    public function getConnection(): PDO
    {
        try {
            $conn = new PDO("mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->database, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            die();
        }
    }

    public function closeConnection(PDO $connection): void
    {
        unset($connection);
    }
}
