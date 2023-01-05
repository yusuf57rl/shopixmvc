<?php

declare(strict_types=1);

namespace App\Core;

use App\Controller\CategoriesController;
use App\Controller\CategoryController;
use App\Controller\ProductController;
use App\Controller\ErrorController;

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

            "" => ErrorController::class,


        ];
    }

}