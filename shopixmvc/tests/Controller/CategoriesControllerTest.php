<?php
declare(strict_types=1);

namespace App\Test\Controller;

use App\Controller\CategoriesController;
use App\Core\Container;
use App\Core\DatabaseConnection;
use App\Core\View;
use App\Model\Category\CategoryMapper;
use App\Model\Category\CategoryRepository;
use PHPUnit\Framework\TestCase;

class CategoriesControllerTest extends TestCase
{
    public function testLoad(): void
    {
        $dbConnection = new DatabaseConnection(testing: true);
        $connection = $dbConnection->getConnection();

        $container = new Container();
        $container->set(CategoryRepository::class, new CategoryRepository(new CategoryMapper(), $connection));

        $view = new View(new \Smarty());

        $container->set(View::class, $view);
        $categoriesController = new CategoriesController($container);
        $categoriesController->load();

        $category = $view->getTemplateParameter('categories');
        //Count
        self::assertCount(3, $category);

        //Category 1
        self::assertSame(1, $category[0]->getId());
        self::assertSame('T-Shirt', $category[0]->getName());
        self::assertSame('Qualitativ hochwertig', $category[0]->getDesignation());

        //Category 2
        self::assertSame(2, $category[1]->getID());
        self::assertSame('Jacken', $category[1]->getName());
        self::assertSame('100% Baumwolle', $category[1]->getDesignation());

        //Category 3
        self::assertSame(3, $category[2]->getID());
        self::assertSame('Hosen', $category[2]->getName());
        self::assertSame('Elastisch', $category[2]->getDesignation());

        // Template Test
        self::assertSame('HomeView.tpl', $view->getTemplate());

        $dbConnection->closeConnection($connection);
    }
}