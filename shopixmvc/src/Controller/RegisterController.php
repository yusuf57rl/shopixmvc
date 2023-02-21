<?php
declare(strict_types=1);


namespace App\Controller;

use App\Core\Container;
use App\Core\View;
use App\Model\DTO\UserDTO;
use App\Model\User\UserEntityManager;
use App\Model\User\UserRepository;

class RegisterController implements ControllerInterface
{
    private UserEntityManager $userEntityManager;
    private View $view;
    private object $UserRepository;

    public function __construct(Container $container)
    {
        $this->view = $container->get(View::class);
        $this->userEntityManager = $container->get(UserEntityManager::class);
        $this->UserRepository = $container->get(UserRepository::class);
    }

    public function load(): void
    {
        $errors = [];

        if (isset($_POST['register'])) {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $verPassword = $_POST['verPassword'] ?? '';

            if ($this->UserRepository->checkUsername($username) instanceof UserDTO) {
                $errors[] = 'User with this username already exists';
            }

            if ($password !== $verPassword) {
                $errors[] = 'Verification doesnt match Password';
            }

            //if no error

            if(empty($errors)) {
                $userDTO = new UserDTO();
                $userDTO->setUsername($username);
                $userDTO->setPassword($password);
                $userDTO->setVerification($verPassword);

                $this->userEntityManager->create($userDTO);
            }
        }

        $this->view->addTemplateParameter('errors', $errors);
        $this->view->setTemplate('Register.tpl');
    }

}