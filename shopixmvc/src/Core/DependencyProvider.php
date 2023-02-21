<?php

namespace App\Core;

use App\Model\Category\CategoryMapper;
use App\Model\Category\CategoryRepository;
use App\Model\Product\ProductMapper;
use App\Model\Product\ProductRepository;

class DependencyProvider
{
    public function provide(Container $container, \PDO $PDO, \Smarty $smarty): void
    {
        $container->set(View::class, new View($smarty));

        //Repository's
        $container->set(CategoryRepository::class, new CategoryRepository(new CategoryMapper(), $PDO));
        $container->set(ProductRepository::class, new ProductRepository(new ProductMapper(), $PDO));

    }
}