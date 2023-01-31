<?php
declare(strict_types=1);

namespace App\Test\Core;

use App\Controller\CategoriesController;
use App\Controller\CategoryController;
use App\Controller\ProductController;
use App\Core\ControllerProvider;
use PHPUnit\Framework\TestCase;

class ControllerProviderTest extends TestCase
{
    public function testGetList(): void
    {
        $controllerProvider = new ControllerProvider();
        $list = $controllerProvider->getList();

        self::assertEquals(CategoryController::class, $list['category']);
        self::assertEquals(ProductController::class, $list['product']);
        self::assertEquals(CategoriesController::class, $list['categories']);
    }
}
