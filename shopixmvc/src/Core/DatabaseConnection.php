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

public function getConnection(): false|PDO
    {

        try {
            $dsn = "mysql:dbname={$this->database};host:{$this->host}";
            $conn = new PDO($dsn, $this->username, $this->password);
            $conn->exec("set names utf8");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            return false;
        }

        return $conn;
    }
}