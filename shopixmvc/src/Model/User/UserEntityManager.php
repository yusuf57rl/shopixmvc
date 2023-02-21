<?php
declare(strict_types=1);

namespace App\Model\User;

use App\Model\DTO\UserDTO;

class UserEntityManager
{
    public function __construct(
        private readonly \PDO         $PDO
    )
    {
    }

    public function create(UserDTO $userDTO): void
    {
        $password = password_hash($userDTO->getPassword(), PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $this->PDO->prepare($sql);
        $stmt->execute([$userDTO->getUsername(), $password]);
    }
}