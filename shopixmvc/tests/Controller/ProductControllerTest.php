<?php
declare(strict_types=1);

namespace App\Test\Controller;

use App\Controller\ProductController;
use App\Core\Container;
use App\Core\DatabaseConnection;
use App\Core\View;
use App\Model\Product\ProductMapper;
use App\Model\Product\ProductRepository;
use PHPUnit\Framework\TestCase;

class ProductControllerTest extends TestCase
{
    public function testLoad(): void
    {
        $dbConnection = new DatabaseConnection(testing: true);
        $connection = $dbConnection->getConnection();

        $container = new Container();
        $container->set(ProductRepository::class, new ProductRepository(new ProductMapper(), $connection));

        $view = new View(new \Smarty());

        $_GET["id"] = 1;
        $container->set(View::class, $view);
        $productController = new ProductController($container);
        $productController->load();

        $products = $view->getTemplateParameter('product');

        self::assertSame(1, $products->getId());
        self::assertSame('Alpha T-Shirt', $products->getName());
        self::assertSame(1, $products->getCategoryId());
        self::assertSame('Alpha T-Shirt Qualität', $products->getDescription());
        self::assertSame(20.0, $products->getPrice());

        self::assertSame('ProductView.tpl', $view->getTemplate());

        $dbConnection->closeConnection($connection);
    }
    protected function tearDown(): void
    {
        $dbConnection = new DatabaseConnection(testing: true);
        $connection = $dbConnection->getConnection();
        $connection->exec("DELETE FROM products WHERE price = 666.66");
    }

}