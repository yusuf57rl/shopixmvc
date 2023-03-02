<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Model\User\UserRepository;

class UserRepositoryTest extends TestCase
{
    private UserRepository $userRepository;

    protected function setUp(): void
    {
        $pdo = new PDO('sqlite::memory:');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $pdo->exec("
            CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY,
                username TEXT NOT NULL,
                password TEXT NOT NULL,
                verification TEXT NOT NULL,
                rank INTEGER DEFAULT 0
            );
        ");

        $this->userRepository = new UserRepository($pdo);
    }

    public function testCheckUsernameWithExistingUser(): void
    {
        $pdo = new PDO('sqlite::memory:');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $pdo->exec("
            CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY,
                username TEXT NOT NULL,
                password TEXT NOT NULL,
                verification TEXT NOT NULL,
                rank INTEGER DEFAULT 0
            );
        ");

        $statement = $pdo->prepare('INSERT INTO users (username, password, verification) VALUES (:username, :password, :verification)');
        $statement->execute([
            'username' => 'testuser',
            'password' => password_hash('testpassword', PASSWORD_DEFAULT),
            'verification' => 'testpassword'
        ]);

        $this->assertFalse($this->userRepository->checkUsername('testuser'));
    }

    public function testCheckUsernameWithNonExistingUser(): void
    {
        $this->assertTrue($this->userRepository->checkUsername('testuser'));
    }

    protected function tearDown(): void
    {
        $this->userRepository = null;
    }
}