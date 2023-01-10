<?php

namespace App\Test\Controller;

use App\Controller\CategoryController;
use App\Core\Container;
use App\Core\View;
use App\Model\Category\CategoryRepository;
use App\Model\Product\ProductRepository;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertSame;

class CategoryControllerTest extends TestCase
{
    public function testLoad(): void
    {
        $container = new Container();
        $container->set(ProductRepository::class, new ProductRepository(__DIR__ . '/../../src/Model/Product/products.json'));

        $view = new View(new \Smarty());

        $_GET["id"] = "1";
        $container->set(View::class, $view);
        $categoryController = new CategoryController($container);
        $categoryController->load();

        $products = $view->getTemplateParameter('products');

        //Count
        self::assertCount(3, $products);

        //Category 1
        self::assertSame('1', $products[0]['id']);
        self::assertSame('Alpha T-Shirt', $products[0]['name']);
        self::assertSame('1', $products[0]['categoryid']);
        self::assertSame('Alpha T-Shirt Qualität', $products[0]['description']);
        self::assertSame(109.99, $products[1]['price']);

        //Product 2
        self::assertSame('2', $products[1]['id']);
        self::assertSame('Gucci T-Shirt', $products[1]['name']);
        self::assertSame('1', $products[0]['categoryid']);
        self::assertSame('Gucci T-Shirt Qualität', $products[1]['description']);
        self::assertSame(109.99, $products[1]['price']);

        //Product 3
        self::assertSame('3', $products[2]['id']);
        self::assertSame('DSQUARED2 T-Shirt', $products[2]['name']);
        self::assertSame('1', $products[0]['categoryid']);
        self::assertSame('DSQUARED2 T-Shirt Qualität', $products[2]['description']);
        self::assertSame(100.24, $products[2]['price']);

        //Template Test
        self::assertSame('CategoryView.tpl', $view->getTemplate());
    }

    public function testFindAllNegative(): void
    {
        $container = new Container();
        $container->set(ProductRepository::class, new ProductRepository(__DIR__ . '/../../src/Model/Product/products.json'));

        $view = new View(new \Smarty());

        $_GET["id"] = "666";
        $container->set(View::class, $view);
        $categoryController = new CategoryController($container);
        $categoryController->load();

        $category = $view->getTemplateParameter('products');

        //Count
        self::assertCount(0, $category);
    }
}