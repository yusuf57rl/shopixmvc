<?php

namespace App\Test\Controller;

use App\Controller\CategoriesController;
use App\Core\Container;
use App\Core\View;
use App\Model\Category\CategoryRepository;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertSame;

class CategoriesControllerTest extends TestCase
{
    public function testLoad(): void
    {
        $container = new Container();
        $container->set(CategoryRepository::class, new CategoryRepository(__DIR__.'/../../src/Model/Category/category.json'));

        $view = new View(new \Smarty());

        $container->set(View::class, $view);
        $categoriesController = new CategoriesController($container);
        $categoriesController->load();

        $category = $view->getTemplateParameter('categories');
        //Count
        self::assertCount(3, $category);

        //Category 1
        self::assertSame('1', $category[0]['id']);
        self::assertSame('T-Shirt', $category[0]['name']);
        self::assertSame('Qualitativ hochwertig', $category[0]['designation']);

        //Category 2
        self::assertSame('2', $category[1]['id']);
        self::assertSame('Jacken', $category[1]['name']);
        self::assertSame('100% Baumwolle', $category[1]['designation']);

        //Category 3
        self::assertSame('3', $category[2]['id']);
        self::assertSame('Hosen', $category[2]['name']);
        self::assertSame('Elastisch', $category[2]['designation']);

        // Template Test
        self::assertSame('HomeView.tpl', $view->getTemplate());
    }
}