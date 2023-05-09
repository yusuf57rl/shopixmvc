<?php
declare(strict_types=1);

namespace App\Test\Controller;

use App\Core\Container;
use App\Core\View;
use App\Controller\RegisterController;
use App\Model\DTO\UserDTO;
use App\Model\User\UserEntityManager;
use App\Model\User\UserRepository;
use PHPUnit\Framework\TestCase;

class RegisterControllerTest extends TestCase
{
    private Container $container;
    private View $view;
    private UserEntityManager $userEntityManager;
    private UserRepository $userRepository;

    protected function setUp(): void
    {
        $this->view = $this->createMock(View::class);
        $this->userEntityManager = $this->createMock(UserEntityManager::class);
        $this->userRepository = $this->createMock(UserRepository::class);

        $this->container = new Container();
        $this->container->set(View::class, $this->view);
        $this->container->set(UserEntityManager::class, $this->userEntityManager);
        $this->container->set(UserRepository::class, $this->userRepository);
    }

    public function testLoadWithoutError(): void
    {
        $userRepository = $this->createMock(UserRepository::class);
        $userEntityManager = $this->createMock(UserEntityManager::class);
        $view = $this->createMock(View::class);

        $container = new Container();
        $container->set(UserRepository::class, $userRepository);
        $container->set(UserEntityManager::class, $userEntityManager);
        $container->set(View::class, $view);

        $view->expects($this->once())
            ->method('setTemplate')
            ->with('Register.tpl');

        $_POST['register'] = true;
        $_POST['username'] = 'test';
        $_POST['password'] = 'password';
        $_POST['verPassword'] = 'password';

        $userRepository->method('getUserByUsername')
            ->willReturn(null);

        $userEntityManager->expects($this->once())
            ->method('create');


        $view->expects($this->exactly(2))
            ->method('addTemplateParameter')
            ->withConsecutive(
                ['postSend', true],
                ['errors', []]
            );

        $controller = new RegisterController($container);
        $controller->load();
    }

    public function testLoadWithError(): void
    {
        $userRepository = $this->createMock(UserRepository::class);
        $userEntityManager = $this->createMock(UserEntityManager::class);
        $view = $this->createMock(View::class);

        $container = new Container();
        $container->set(UserRepository::class, $userRepository);
        $container->set(UserEntityManager::class, $userEntityManager);
        $container->set(View::class, $view);

        $view->expects($this->once())
            ->method('setTemplate')
            ->with('Register.tpl');

        $_POST['register'] = true;
        $_POST['username'] = 'test';
        $_POST['password'] = 'password';
        $_POST['verPassword'] = 'password';

        $userRepository->method('getUserByUsername')
            ->willReturn(new UserDTO());

        $userEntityManager->expects($this->never())
            ->method('create');

        $view->expects($this->exactly(2))
            ->method('addTemplateParameter')
            ->withConsecutive(
                ['postSend', true],
                ['errors', ['User with this username already exists']]
            );

        $controller = new RegisterController($container);
        $controller->load();
    }

    public function testLoadWithMismatchPassword(): void
    {
        $userRepository = $this->createMock(UserRepository::class);
        $userEntityManager = $this->createMock(UserEntityManager::class);
        $view = $this->createMock(View::class);

        $container = new Container();
        $container->set(UserRepository::class, $userRepository);
        $container->set(UserEntityManager::class, $userEntityManager);
        $container->set(View::class, $view);

        $view->expects($this->once())
            ->method('setTemplate')
            ->with('Register.tpl');

        $_POST['register'] = true;
        $_POST['username'] = 'test';
        $_POST['password'] = 'password';
        $_POST['verPassword'] = 'differentPassword';

        $userRepository->method('getUserByUsername')
            ->willReturn(null);

        $view->expects($this->exactly(2))
            ->method('addTemplateParameter')
            ->withConsecutive(
                ['postSend', true],
                ['errors', ['Verification doesnt match Password']]
            );

        $controller = new RegisterController($container);
        $controller->load();
    }


}
