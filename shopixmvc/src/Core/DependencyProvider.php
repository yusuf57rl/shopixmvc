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

        // Repositories
        $container->set(CategoryRepository::class, new CategoryRepository(new CategoryMapper(), $PDO));
        $container->set(ProductRepository::class, new ProductRepository(new ProductMapper(), $PDO));
        $container->set(UserRepository::class, new UserRepository($PDO, new UserMapper(), new UserDTO()));

        // Entity Managers
        $container->set(UserEntityManager::class, new UserEntityManager($PDO));
    }
}
