<?php

declare(strict_types=1);

namespace App\Core;

use App\Controller\CategoriesController;
use App\Controller\CategoryController;
use App\Controller\LoginController;
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

            "categories" => CategoriesController::class,

            "login" => LoginController::class,

        ];
    }
}