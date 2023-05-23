<?php

declare(strict_types=1);

use App\Core\DatabaseConnection;
use App\Model\DTO\UserDTO;
use App\Model\User\UserMapper;
use PHPUnit\Framework\TestCase;
use App\Model\User\UserRepository;

class UserRepositoryTest extends TestCase
{
    private ?UserRepository $userRepository;
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

        $userMapper = new UserMapper();
        $userDTO = new UserDTO();
        $this->userRepository = new UserRepository($this->pdo, $userMapper, $userDTO);
    }

    public function testGetUserById(): void
    {
        $username = 'testuser';
        $password = password_hash('testpassword', PASSWORD_DEFAULT);

        $statement = $this->pdo->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
        $statement->execute([
            'username' => $username,
            'password' => $password,
        ]);

        $id = (int) $this->pdo->lastInsertId();

        $user = $this->userRepository->getUserById($id);
        $this->assertInstanceOf(UserDTO::class, $user);
        $this->assertEquals($username, $user->getUsername());
    }


    public function testGetUserByUsername(): void
    {
        $username = 'testuser';
        $password = password_hash('testpassword', PASSWORD_DEFAULT);

        $statement = $this->pdo->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
        $statement->execute([
            'username' => $username,
            'password' => $password,
        ]);

        $id = (int) $this->pdo->lastInsertId();

        $user = $this->userRepository->getUserByUsername($username);
        $this->assertInstanceOf(UserDTO::class, $user);
        $this->assertEquals($id, $user->getId());
    }

    public function testGetNonExistingUserByUsername(): void
    {
        $username = 'nonExistingUser';

        $user = $this->userRepository->getUserByUsername($username);
        $this->assertNull($user);
    }

    public function testCreateUser(): void
    {

        $username = 'newUser';
        $password = password_hash('newPassword', PASSWORD_DEFAULT);
        $verification = 'newPassword';

        $userDTO = new UserDTO();
        $userDTO->setUsername($username);
        $userDTO->setPassword($password);

        // Rufen Sie die createUser Funktion auf
        $this->userRepository->createUser($userDTO);

        // Überprüfen Sie, ob der Benutzer korrekt in der Datenbank erstellt wurde
        $createdUser = $this->userRepository->getUserByUsername($username);
        $this->assertEquals($username, $createdUser->getUsername());
        $this->assertTrue(password_verify('newPassword', $createdUser->getPassword()));
    }

    public function testUpdateUser(): void
    {
        // Erstellen Sie einen Benutzer in der Datenbank
        $username = 'testuser';
        $password = password_hash('testpassword', PASSWORD_DEFAULT);

        $statement = $this->pdo->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
        $statement->execute([
            'username' => $username,
            'password' => $password,
        ]);

        $id = (int) $this->pdo->lastInsertId();

        // Aktualisieren Sie den Benutzer und überprüfen Sie, ob die Änderungen korrekt in der Datenbank gespeichert wurden.
        $newUsername = 'updatedUser';
        $newPassword = password_hash('updatedPassword', PASSWORD_DEFAULT);
        $newVerification = 'updatedPassword';

        $userDTO = new UserDTO();
        $userDTO->setId($id);
        $userDTO->setUsername($newUsername);
        $userDTO->setPassword($newPassword);

        $this->userRepository->updateUser($userDTO);

        $updatedUser = $this->userRepository->getUserById($id);
        $this->assertEquals($newUsername, $updatedUser->getUsername());
        $this->assertTrue(password_verify('updatedPassword', $updatedUser->getPassword()));
    }


    public function testDeleteUser(): void
    {
        $username = 'testuser';
        $password = password_hash('testpassword', PASSWORD_DEFAULT);

        $statement = $this->pdo->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
        $statement->execute([
            'username' => $username,
            'password' => $password,
        ]);

        $id = (int) $this->pdo->lastInsertId();

        $this->userRepository->deleteUser($id);

        $deletedUser = $this->userRepository->getUserById($id);
        $this->assertNull($deletedUser);
    }


    protected function tearDown(): void
    {
        $this->userRepository = null;
        $this->pdo = null;
    }
}
