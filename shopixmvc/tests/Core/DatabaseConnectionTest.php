<?php
declare(strict_types=1);

namespace App\Test\Core;

use PHPUnit\Framework\TestCase;
use App\Core\DatabaseConnection;

class DatabaseConnectionTest extends TestCase
{
    private $databaseConnection;

    protected function setUp(): void
    {
        $this->databaseConnection = new DatabaseConnection();
    }

    public function testCanConnectToDatabase()
    {
        $connection = $this->databaseConnection->getConnection();
        $this->assertInstanceOf(\PDO::class, $connection);
    }

    public function testConnectionError()
    {
        // RANDOM DATEN
        $this->databaseConnection = new DatabaseConnection('localhost', 'root', 'password', 'nonexistent_database');

        $this->expectException(\PDOException::class);
        $this->databaseConnection->getConnection();
    }

    protected function tearDown(): void
    {
        $this->databaseConnection = null;
    }
}