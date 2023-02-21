<?php
declare(strict_types=1);

namespace App\Model\User;

class UserRepository
{

    public function __construct(
        private readonly \PDO         $PDO
    )
    {
    }

    public function checkUsername(): bool
    {
        $statement = $this->PDO
            ->prepare('SELECT * FROM users');
        $statement->execute();

        $results = $statement
            ->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($results as $result) {
            if ($result["username"] === $_POST["username"]) {
                return false;
            }
        }
        return true;
    }
}