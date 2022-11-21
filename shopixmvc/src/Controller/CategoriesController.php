<?php

namespace App\Controller;


use App\Core\View;
use App\Model\Category\CategoryRepository;

class CategoriesController
{
    public function __construct(private CategoryRepository $categoryRepository,  private View $view)
    {
    }

    public function load()
    {
        $categories = $this->categoryRepository->findAll();

        $this->view->addTemplateParameter('categories', $categories);
        $this->view->setTemplate('HomeView.tpl');
    }
}