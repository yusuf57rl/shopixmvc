<?php
declare(strict_types=1);

namespace App\Controller;

use App\Core\Container;
use App\Core\View;
use App\Model\User\UserRepository;

class LoginController
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