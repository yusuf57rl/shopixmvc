<?php

namespace App\Core;

use App\Controller\ProductController;
use App\Model\Category\CategoryRepository;
use App\Model\Product\ProductRepository;

class DependencyProvider
{
    public function provide(Container $container): void
    {
        $container->set(View::class, new View(new \Smarty()));

//Repositorys
        $container->set(CategoryRepository::class, new CategoryRepository());
        $container->set(ProductRepository::class, new ProductRepository());

    }
}