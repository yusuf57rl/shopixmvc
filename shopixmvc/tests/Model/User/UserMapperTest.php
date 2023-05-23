<?php
declare(strict_types=1);

namespace App\Test\Model\User;

use App\Model\DTO\UserDTO;
use App\Model\User\UserRepository;
use App\Model\User\UserMapper;
use PHPUnit\Framework\TestCase;

class UserMapperTest extends TestCase
{
    public function testGetVerification(): void
    {
        $user = new UserDTO();
        $verification = 'test_verification';
        $user->setVerification($verification);
        $this->assertSame($verification, $user->getVerification());
    }

}