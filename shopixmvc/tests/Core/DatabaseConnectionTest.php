<?php
declare(strict_types=1);

namespace App\Test\Core;

use PHPUnit\Framework\TestCase;
use App\Core\DatabaseConnection;

class DatabaseConnectionTest extends TestCase
{
    private DatabaseConnection $databaseConnection;

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

    public function testCanConnectToInMemorySqlite()
    {
        $this->databaseConnection = new DatabaseConnection(testing: true);
        $connection = $this->databaseConnection->getConnection();
        $this->assertInstanceOf(\PDO::class, $connection);
        $this->assertEquals('sqlite', $connection->getAttribute(\PDO::ATTR_DRIVER_NAME));
    }

    public function testCanCloseConnection()
    {
        $connection = $this->databaseConnection->getConnection();
        $this->assertInstanceOf(\PDO::class, $connection);

        $this->databaseConnection->closeConnection($connection);
        $this->assertNull($connection);
    }

    protected function tearDown(): void
    {
        $this->databaseConnection = null;
    }
}
