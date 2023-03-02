<?php

namespace App\Core;

use App\Controller\LoginController;
use App\Model\Category\CategoryMapper;
use App\Model\Category\CategoryRepository;
use App\Model\Product\ProductMapper;
use App\Model\Product\ProductRepository;
use App\Model\User\UserEntityManager;
use App\Model\User\UserMapper;
use App\Model\DTO\UserDTO;
use App\Model\User\UserRepository;

class DependencyProvider
{
    public function provide(Container $container, \PDO $PDO, \Smarty $smarty): void
    {
        $container->set(View::class, new View($smarty));

        // PDO
        $dbConfig = require __DIR__ . 'databaseConnection.php';
        $pdo = new \PDO($dbConfig['dsn'], $dbConfig['username'], $dbConfig['password']);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $container->set(\PDO::class, $pdo);

        // Repositories
        $container->set(CategoryRepository::class, new CategoryRepository(new CategoryMapper(), $PDO));
        $container->set(ProductRepository::class, new ProductRepository(new ProductMapper(), $PDO));
        $container->set(UserRepository::class, new UserRepository(new UserMapper(), new UserDTO(), $PDO));

        // Entity Managers
        $container->set(UserEntityManager::class, new UserEntityManager($pdo));

        // Authentication
        $container->set(LoginController::class, new LoginController($container->get(UserRepository::class)));

        // Set isAdmin
        $container->get(View::class)->assign('isAdmin', $container->get(LoginController::class)->isAdmin());
    }
}
