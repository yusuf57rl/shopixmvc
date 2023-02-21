<?php
declare(strict_types=1);


namespace App\Model\User;


use App\Model\DTO\UserDTO;

class UserMapper
{
public function map(array $userList): UserDTO
{
$userDTO = new UserDTO();

$userDTO->setId($userList['id']);
$userDTO->setUsername($userList['username']);
$userDTO->setPassword($userList['password']);
$userDTO->setVerification($userList['verification']);

return $userDTO;

}
}