<?php

namespace App\Core;

use App\Controller\ProductController;
use App\Model\Category\CategoryMapper;
use App\Model\Category\CategoryRepository;
use App\Model\DTO\CategoryDTO;
use App\Model\Product\ProductMapper;
use App\Model\Product\ProductRepository;

class DependencyProvider
{
    public function provide(Container $container): void
    {
        $container->set(View::class, new View(new \Smarty()));

        //Repository's

        $container->set(CategoryRepository::class, new CategoryRepository(new CategoryMapper()));
        $container->set(ProductRepository::class, new ProductRepository(new ProductMapper()));

    }
}