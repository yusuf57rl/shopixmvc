<?php


namespace App\Core;


use PDO;
use PDOException;

class DatabaseConnection
{

    private string $host = "localhost:3336";
    private string $username = "root";
    private string $password = "nexus123";
    private string $database = "shopixmvc";


    public function getConnection() {

        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }

}