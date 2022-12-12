<?php

declare(strict_types=1);

namespace App\Core;

use App\Controller\CategoriesController;
use App\Controller\CategoryController;
use App\Controller\ProductController;

class ControllerProvider
{


    public function getList(): array
    {


        return [

            "category" => CategoryController::class,

            "product" => ProductController::class,

            "home" => CategoriesController::class,

            "" => CategoriesController::class,

        ];
    }

}