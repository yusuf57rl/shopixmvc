<?php
declare(strict_types=1);


namespace App\Controller;

use App\Core\Container;
use App\Core\View;
use smarty;

class LoginController {
    private $smarty;
    private $userModel;
    private View $view;


    function __construct(Container $container) {
        $this->view = $container->get(View::class);
        $this->userModel = new UserModel();
    }

    public function load(): void {

        $this->view->setTemplate('Login.tpl');
    }

    public function validateUserCredentials($username, $password) {
        $user = $this->userModel->getUserByUsername($username);

        if (!$user) {
            // Benutzername existiert nicht in der Datenbank
            return false;
        }

        // Überprüfen, ob das eingegebene Passwort mit dem in der Datenbank gespeicherten übereinstimmt
        if (password_verify($password, $user['password'])) {
            return true;
        } else {
            // Falsches Passwort
            return false;
        }
    }

}