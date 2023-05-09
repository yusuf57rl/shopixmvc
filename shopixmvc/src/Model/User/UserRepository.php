<?php

declare(strict_types=1);

namespace App\Model\User;

use App\Model\DTO\UserDTO;

class UserRepository
{
    public function __construct(
        private readonly \PDO $PDO,
        private readonly UserMapper $userMapper,
        private readonly UserDTO $userDTO,
    ) {
    }

    public function getUserById(int $id): ?UserDTO
    {
        $statement = $this->PDO->prepare('SELECT * FROM users WHERE id = :id');
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetch(\PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        return $this->userMapper->map($result);
    }

    public function getUserByUsername(string $username): ?UserDTO
    {
        $statement = $this->PDO->prepare('SELECT * FROM users WHERE username = :username');
        $statement->bindValue(':username', $username, \PDO::PARAM_STR);
        $statement->execute();

        $result = $statement->fetch(\PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        return $this->userMapper->map($result);
    }

    public function createUser(UserDTO $user): void
    {
        $statement = $this->PDO->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
        $statement->bindValue(':username', $user->getUsername(), \PDO::PARAM_STR);
        $statement->bindValue(':password', $user->getPassword(), \PDO::PARAM_STR);
        $statement->execute();
    }

    public function updateUser(UserDTO $user): void
    {
        $statement = $this->PDO->prepare('UPDATE users SET username = :username, password = :password WHERE id = :id');
        $statement->bindValue(':username', $user->getUsername(), \PDO::PARAM_STR);
        $statement->bindValue(':password', $user->getPassword(), \PDO::PARAM_STR);
        $statement->bindValue(':id', $user->getId(), \PDO::PARAM_INT);
        $statement->execute();
    }

    public function deleteUser(int $id): void
    {
        $statement = $this->PDO->prepare('DELETE FROM users WHERE id = :id');
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }
}
