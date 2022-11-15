<?php

namespace App\Controller;


use App\Model\Category\CategoryRepository;
use Smarty;

class CategoriesController
{
    public function __construct(private CategoryRepository $categoryRepository)
    {
    }

    public function load(): void
    {
        $categories = $this->categoryRepository->findAll();
        $smarty = new Smarty;
        $smarty->assign('categories', $categories);
        $smarty->display('HomeView.tpl');
    }
}