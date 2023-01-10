<?php

declare(strict_types=1);

namespace App\Core;

use App\Controller\CategoriesController;
use App\Controller\CategoryController;
use App\Controller\HomeController;
use App\Controller\ProductController;

class ControllerProvider
{

    /**
     * @return string[]
     */
    public function getList(): array
    {


        return [

            "category" => CategoryController::class,

            "product" => ProductController::class,

            "home" => CategoriesController::class,

            "categories" => CategoriesController::class,

            "" => CategoriesController::class,


        ];
    }

}