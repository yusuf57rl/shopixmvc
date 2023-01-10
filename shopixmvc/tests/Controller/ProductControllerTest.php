<?php

namespace App\Test\Controller;

use App\Controller\ProductController;
use App\Core\Container;
use App\Core\View;
use App\Model\Product\ProductRepository;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertSame;

class ProductControllerTest extends TestCase
{
    public function testLoad(): void
    {
        $container = new Container();
        $container->set(ProductRepository::class, new ProductRepository(__DIR__ . '/../../src/Model/Product/products.json'));

        $view = new View(new \Smarty());

        $_GET["id"] = "1";
        $container->set(View::class, $view);
        $productController = new ProductController($container);
        $productController->load();

        $products = $view->getTemplateParameter('product');

        self::assertSame('1', $products['id']);
        self::assertSame('Alpha T-Shirt', $products['name']);
        self::assertSame('1', $products['categoryid']);
        self::assertSame('Alpha T-Shirt Qualität', $products['description']);
        self::assertSame(20.0, $products['price']);

        self::assertSame('ProductView.tpl', $view->getTemplate());
    }
}