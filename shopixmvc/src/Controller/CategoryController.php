<?php

namespace App\Controller;

new \App\Model\Category\CategoryModel();


class CategoryController
{

    public function clothes(): array
    {
        require_once __DIR__ . '../Model/Category/CategoryModel.php';

    }
}