<?php

declare(strict_types=1);

use App\Core\DatabaseConnection;
use App\Model\DTO\UserDTO;
use PHPUnit\Framework\TestCase;
use App\Model\User\UserEntityManager;
use PDO;

class UserEntityManagerTest extends TestCase
{

    private ?UserEntityManager $userEntityManager;

    private ?PDO $pdo;

    protected function setUp(): void
    {
        $databaseConnection = new DatabaseConnection(testing: true);
        $this->pdo = $databaseConnection->getConnection();

        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY,
                username TEXT NOT NULL,
                password TEXT NOT NULL
            );
        ");

        $this->userEntityManager = new UserEntityManager($this->pdo);
    }

    public function testCreateUser(): void
    {
        $username = 'testuser';
        $password = 'testpassword';

        $userDTO = new UserDTO();
        $userDTO->setUsername($username);
        $userDTO->setPassword($password);

        $this->userEntityManager->create($userDTO);

        // Check if the user was created in the database.
        $statement = $this->pdo->prepare('SELECT * FROM users WHERE username = :username');
        $statement->bindValue(':username', $username, \PDO::PARAM_STR);
        $statement->execute();

        $result = $statement->fetch(\PDO::FETCH_ASSOC);

        $this->assertNotNull($result);
        $this->assertEquals($username, $result['username']);
        $this->assertTrue(password_verify($password, $result['password']));
    }

    protected function tearDown(): void
    {
        $this->userEntityManager = null;
        $this->pdo = null;
    }
}
