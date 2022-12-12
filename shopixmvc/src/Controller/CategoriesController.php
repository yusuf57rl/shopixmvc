<?php

namespace App\Controller;

use PHPUnit\Framework\TestCase;
use App\Core\Container;
use App\Core\View;
use App\Model\Category\CategoryRepository;

class CategoriesController extends TestCase
{
    private View $view;
    private CategoryRepository $categoryRepository;

    public function __construct(Container $container)
    {
        $this->view = $container->get(View::class);
        $this->categoryRepository = $container->get(CategoryRepository::class);
    }

    public function load()
    {
        $categories = $this->categoryRepository->findAll();

        $this->view->addTemplateParameter('categories', $categories);
        $this->view->setTemplate('HomeView.tpl');
        $this->view->display();
    }

    public function testAdd(){
        self::assertSame(25, $categories = $this->categoryRepository->findAll());
    }
}