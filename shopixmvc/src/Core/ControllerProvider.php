<?php

declare(strict_types=1);

namespace App\Core;

use App\Controller\AdminController;
use App\Controller\CategoriesController;
use App\Controller\CategoryController;
use App\Controller\LoginController;
use App\Controller\ProductController;
use App\Controller\RegisterController;

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

            "register" => RegisterController::class,

            "admin" => AdminController::class,

        ];
    }
}