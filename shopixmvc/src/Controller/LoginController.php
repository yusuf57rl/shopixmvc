<?php
declare(strict_types=1);

namespace App\Controller;

use App\Core\Container;
use App\Core\Redirector;
use App\Core\View;
use App\Model\DTO\UserDTO;
use App\Model\User\UserRepository;

class LoginController implements ControllerInterface
{
    private View $view;
    private UserRepository $userRepository;
    public Redirector $redirector;
    private array $errors;

    public function __construct(Container $container)
    {
        $this->view = $container->get(View::class);
        $this->userRepository = $container->get(UserRepository::class);
        $this->redirector = $container->get(Redirector::class);
    }

    public function load(): void
    {
        $this->errors = [];
        $this->view->setTemplate('Login.tpl');

        if (isset($_POST['login'])) {
            $user = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $userDTO = $this->userRepository->getUserByUsername($user);

            if (!$userDTO instanceof UserDTO) {
                $this->errors[] = 'USERDTO ERROR';
            } else {
                if (!password_verify($password, $userDTO->getPassword())) {
                    $this->errors[] = 'Password falsch!';
                } else {
                    $_SESSION['user']['name'] = $user;
                    $this->redirector->redirectTo('/?page=admin');
                }
            }
        }

        if (!empty($this->errors)) {
            $this->view->addTemplateParameter('loginError', 'Falsche Zugangsdaten!');
        }
    }


    public function validateUserCredentials(string $username, string $password): bool
    {
        $user = $this->userRepository->getUserByUsername($username);

        if (!$user) {
            return false;
        }

        if (password_verify($password, $user->getPassword())) {
            return true;
        } else {
            return false;
        }
    }
}
