<?php
declare(strict_types=1);

namespace App\Test\Controller;

use App\Core\Redirector;
use PHPUnit\Framework\TestCase;
use App\Controller\LoginController;
use App\Core\Container;
use App\Core\View;
use App\Model\DTO\UserDTO;
use App\Model\User\UserRepository;

class LoginControllerTest extends TestCase
{
    private LoginController $loginController;
    private Container $container;
    private View $view;
    private UserRepository $userRepository;

    public function setUp(): void
    {
        $this->view = $this->createMock(View::class);
        $this->userRepository = $this->createMock(UserRepository::class);

        $this->container = new Container();
        $this->container->set(View::class, $this->view);
        $this->container->set(UserRepository::class, $this->userRepository);
        $this->redirector = new Redirector();
        $this->container->set(Redirector::class, $this->redirector);
        $this->loginController = new LoginController($this->container);
    }

    /**
     * @runInSeparateProcess
     */
    public function testLoad(): void
    {
        $username = 'test';
        $password = '123456';
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $userDTO = new UserDTO();
        $userDTO->setUsername($username);
        $userDTO->setPassword($hashedPassword);

        $this->userRepository->method('getUserByUsername')->willReturn($userDTO);

        $_POST['login'] = true;
        $_POST['username'] = $username;
        $_POST['password'] = $password;

        $this->loginController->load();

        $this->assertArrayHasKey('user', $_SESSION);
        $this->assertEquals($username, $_SESSION['user']['name']);

        $wrongPassword = 'wrong-password';
        $_POST['password'] = $wrongPassword;

        ob_start();
        $this->loginController->load();
        $output = ob_get_clean();

        $this->assertStringContainsString('Password falsch!', $output);

        $nonExistentUsername = 'nonexistent';
        $_POST['username'] = $nonExistentUsername;

        $this->userRepository->method('getUserByUsername')->willReturn(null);

        ob_start();
        $this->loginController->load();
        $output = ob_get_clean();

        $this->assertStringContainsString('USERDTO ERROR', $output);
    }
    public function testLoad_LoginNotSet(): void
    {
        $this->view->expects($this->once())
            ->method('setTemplate')
            ->with('Login.tpl');

        $this->loginController->load();
    }

    public function testLoad_InvalidUserDTO(): void
    {
        $_POST['login'] = true;
        $_POST['username'] = 'nonexistent';
        $_POST['password'] = 'password';

        $this->userRepository->method('getUserByUsername')->willReturn(null);

        $this->view->expects($this->once())
            ->method('setTemplate')
            ->with('Login.tpl');

        ob_start();
        $this->loginController->load();
        $output = ob_get_clean();

        $this->assertStringContainsString('USERDTO ERROR', $output);
    }

    public function testLoad_WrongPassword(): void
    {
        $username = 'test';
        $password = '123456';
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $userDTO = new UserDTO();
        $userDTO->setUsername($username);
        $userDTO->setPassword($hashedPassword);

        $this->userRepository->method('getUserByUsername')->willReturn($userDTO);

        $_POST['login'] = true;
        $_POST['username'] = $username;
        $_POST['password'] = 'wrong-password';

        $this->view->expects($this->once())
            ->method('setTemplate')
            ->with('Login.tpl');

        ob_start();
        $this->loginController->load();
        $output = ob_get_clean();

        $this->assertStringContainsString('Password falsch!', $output);
    }
    public function testValidateUserCredentials_ValidUser(): void
    {
        $username = 'test';
        $password = '123456';
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $userDTO = new UserDTO();
        $userDTO->setUsername($username);
        $userDTO->setPassword($hashedPassword);

        $this->userRepository->method('getUserByUsername')->willReturn($userDTO);

        $result = $this->loginController->validateUserCredentials($username, $password);

        $this->assertTrue($result);
    }

    public function testValidateUserCredentials_InvalidPassword(): void
    {
        $username = 'test';
        $password = '123456';
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $userDTO = new UserDTO();
        $userDTO->setUsername($username);
        $userDTO->setPassword($hashedPassword);

        $this->userRepository->method('getUserByUsername')->willReturn($userDTO);

        $result = $this->loginController->validateUserCredentials($username, 'wrong-password');

        $this->assertFalse($result);
    }

}
