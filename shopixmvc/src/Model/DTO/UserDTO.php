<?php
declare(strict_types=1);

namespace App\Model\DTO;

class UserDTO
{
    private int $id;
    private string $username;
    private string $password;
    private string $verification;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getVerification(): string
    {
        return $this->verification;
    }

    /**
     * @param string $verification
     */
    public function setVerification(string $verification): void
    {
        $this->verification = $verification;
    }


}