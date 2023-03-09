<?php
declare(strict_types=1);

namespace App\Controller;

use App\Core\Container;
use App\Core\View;
use App\Model\DTO\UserDTO;
use App\Model\User\UserRepository;

class LoginController implements ControllerInterface
{
    private View $view;
    private UserRepository $userRepository;

    public function __construct(Container $container)
    {
        $this->view = $container->get(View::class);
        $this->userRepository = $container->get(UserRepository::class);
    }

    public function load(): void
    {
        $this->view->setTemplate('Login.tpl');

        if(isset($_POST['login'])) {
            $user = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $userDTO = $this->userRepository->getUserByUsername($user);

            if (!$userDTO instanceof UserDTO) {
                //TODO error
            }

            if (password_verify($password, $userDTO->getPassword())) {
                //TODO error
            }

            $_SESSION['user']['role'] = 'admin';
            $_SESSION['user']['name'] = $user;

            header('Location: ?page=admin');
        }
    }

    public function validateUserCredentials(string $username, string $password): bool
    {
        $user = $this->userRepository->getUserByUsername($username);

        if (!$user) {
            // Benutzername existiert nicht in der Datenbank
            return false;
        }

        // Überprüfen, ob das eingegebene Passwort mit dem in der Datenbank gespeicherten übereinstimmt
        if (password_verify($password, $user->getPassword())) {
            return true;
        } else {
            // Falsches Passwort
            return false;
        }
    }
}