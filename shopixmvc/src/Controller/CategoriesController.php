<?php

namespace App\Controller;


use App\Model\Category\CategoryRepository;
use Smarty;
use App\core\addTemplateParameterClass;

class CategoriesController
{
    public function __construct(private CategoryRepository $categoryRepository)
    {
    }

    public function load($categories2)
    {
        $categories2 = $this->categoryRepository->findAll();

    }
}