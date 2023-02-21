<?php
declare(strict_types=1);

namespace App\Test\Controller;

use App\Controller\CategoryController;
use App\Core\Container;
use App\Core\DatabaseConnection;
use App\Core\View;
use App\Model\Product\ProductMapper;
use App\Model\Product\ProductRepository;
use PHPUnit\Framework\TestCase;

class CategoryControllerTest extends TestCase
{
    public function testLoad(): void
    {
        $databaseConnection = new DatabaseConnection();
        $connection = $databaseConnection->getConnection();

        $container = new Container();
        $container->set(ProductRepository::class, new ProductRepository(new ProductMapper(), $connection));

        $view = new View(new \Smarty());

        $_GET["id"] = "1";
        $container->set(View::class, $view);
        $categoryController = new CategoryController($container);
        $categoryController->load();

        $products = $view->getTemplateParameter('products');

        //Count
        self::assertCount(3, $products);

        //Category 1
        self::assertSame(1, $products[0]->getID());
        self::assertSame('Alpha T-Shirt', $products[0]->getName());
        self::assertSame(1, $products[0]->getCategoryID());
        self::assertSame('Alpha T-Shirt Qualität', $products[0]->getDescription());
        self::assertSame(109.99, $products[1]->getPrice());

        //Product 2
        self::assertSame(2, $products[1]->getID());
        self::assertSame('Gucci T-Shirt', $products[1]->getName());
        self::assertSame(1, $products[0]->getCategoryID());
        self::assertSame('Gucci T-Shirt Qualität', $products[1]->getDescription());
        self::assertSame(109.99, $products[1]->getPrice());

        //Product 3
        self::assertSame(3, $products[2]->getID());
        self::assertSame('DSQUARED2 T-Shirt', $products[2]->getName());
        self::assertSame(1, $products["2"]->getCategoryID());
        self::assertSame('DSQUARED2 T-Shirt Qualität', $products[2]->getDescription());
        self::assertSame(100.24, $products[2]->getPrice());

        //Template Test
        self::assertSame('CategoryView.tpl', $view->getTemplate());

        $databaseConnection->closeConnection($connection);
    }

    public function testFindAllNegative(): void
    {
        $databaseConnection = new DatabaseConnection();
        $connection = $databaseConnection->getConnection();

        $container = new Container();
        $container->set(ProductRepository::class, new ProductRepository(new ProductMapper(), $connection));

        $view = new View(new \Smarty());

        $_GET["id"] = "666";
        $container->set(View::class, $view);
        $categoryController = new CategoryController($container);
        $categoryController->load();

        $category = $view->getTemplateParameter('products');

        //Count
        self::assertCount(0, $category);

        $databaseConnection->closeConnection($connection);
    }
}