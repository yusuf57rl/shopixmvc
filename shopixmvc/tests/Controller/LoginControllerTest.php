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
    private Redirector $redirector;

    public function setUp(): void
    {
        ob_start();

        $this->view = $this->getMockBuilder(View::class)
            ->disableOriginalConstructor()
            ->setMethods(['setTemplate', 'assign'])
            ->getMock();
        $this->view->method('assign')->willReturn($this->view);

        $this->userRepository = $this->createMock(UserRepository::class);
        $this->redirector = $this->createMock(Redirector::class);
        $this->redirector->expects($this->once())->method('redirectTo');

        $this->container = new Container();
        $this->container->set(View::class, $this->view);
        $this->container->set(UserRepository::class, $this->userRepository);
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

        $this->view->expects($this->once())
            ->method('setTemplate')
            ->with('Login.tpl');

        $this->loginController->load();

        $this->assertArrayHasKey('user', $_SESSION);
        $this->assertEquals($username, $_SESSION['user']['name']);
    }

    public function testLoad_LoginNotSet(): void
    {
        $this->view->expects($this->once())
            ->method('setTemplate')
            ->with('Login.tpl');

        $this->loginController->load();
    }

    public function testLoad_WrongPassword(): void
    {
        $_POST['login'] = true;
        $_POST['username'] = 'existingUser';
        $_POST['password'] = 'wrongPassword';

        $userDTO = new UserDTO();
        $userDTO->setPassword(password_hash('correctPassword', PASSWORD_DEFAULT));

        $this->userRepository->method('getUserByUsername')->willReturn($userDTO);

        $this->view->expects($this->once())
            ->method('setTemplate')
            ->with('Login.tpl');

        $this->view->expects($this->once())
            ->method('assign')
            ->with('errors', ['Password falsch!']);

        $this->loginController->load();
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
    public function testNonexistentUser(): void
    {
        $username = 'nonexistentUser';
        $password = 'password';

        $this->userRepository->method('getUserByUsername')->willReturn(null);

        $result = $this->loginController->validateUserCredentials($username, $password);

        $this->assertFalse($result);
    }

    public function testLoad_LoginSetButUsernameOrPasswordNotSet(): void
    {
        $_POST['login'] = true;
        $_POST['username'] = ''; // empty username
        $_POST['password'] = 'password'; // non-empty password

        $this->view->expects($this->once())
            ->method('setTemplate')
            ->with('Login.tpl');

        $this->view->expects($this->once())
            ->method('assign')
            ->with('errors', ['USERDTO ERROR']);

        $this->loginController->load();
    }

    public function testLoad_LoginSetButPasswordNotSet(): void
    {
        $_POST['login'] = true;
        $_POST['username'] = 'username'; // non-empty username
        $_POST['password'] = ''; // empty password

        $this->view->expects($this->once())
            ->method('setTemplate')
            ->with('Login.tpl');

        $this->view->expects($this->once())
            ->method('assign')
            ->with('errors', ['USERDTO ERROR']);

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

        $this->view->expects($this->once())
            ->method('assign')
            ->with('errors', ['USERDTO ERROR']);

        $this->loginController->load();
    }

    public function testLoad_InvalidUser(): void
    {
        $_POST['login'] = true;
        $_POST['username'] = 'nonexistent';
        $_POST['password'] = 'password';

        $this->userRepository->method('getUserByUsername')->willReturn(null);

        $this->view->expects($this->once())
            ->method('setTemplate')
            ->with('Login.tpl');

        $this->view->expects($this->once())
            ->method('assign')
            ->with('errors', ['USERDTO ERROR']);

        $this->loginController->load();
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

    public function testLoad_SuccessfulLogin(): void
    {
        $_POST['login'] = true;
        $_POST['username'] = 'existingUser';
        $_POST['password'] = 'correctPassword';

        $userDTO = new UserDTO();
        $userDTO->setPassword(password_hash('correctPassword', PASSWORD_DEFAULT));

        $this->userRepository->method('getUserByUsername')->willReturn($userDTO);

        $this->view->expects($this->once())
            ->method('setTemplate')
            ->with('Login.tpl');

        $this->loginController->redirector->expects($this->once())
            ->method('redirectTo')
            ->with('/?page=admin');

        $this->loginController->load();
    }




    protected function tearDown(): void
    {
        ob_end_clean();
    }

}
