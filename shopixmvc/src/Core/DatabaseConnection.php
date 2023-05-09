<?php


namespace App\Core;

use PDO;
use PDOException;

class DatabaseConnection
{
    public function __construct(
        private $host = "localhost",
        private $username = "root",
        private $password = "nexus123",
        private $database = "shopixmvc",
        private $testing = false,
    )
    {
        if ($this->testing) {
            $this->database = "shopixmvc_test";
        }
    }

    public function getConnection(): PDO
    {
        if ($this->testing) {
            $conn = new PDO('sqlite::memory:');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } else {
            $conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database, $this->username, $this->password);
        }

        return $conn;
    }

    public function closeConnection(PDO $connection): void
    {
        unset($connection);
    }
}
