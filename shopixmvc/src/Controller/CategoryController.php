<?php

namespace App\Controller;

use App\Core\View;
use App\Model\Product\ProductRepository;

class CategoryController
{
    public function __construct(private ProductRepository $productModel,  private View $view)
    {
    }

    public function load(): void
    {
        $categoryId = $_GET['id'] ?? '';

        $products = $this->productModel->findByCategoryId($categoryId);

        $this->view->addTemplateParameter('products', $products);
        $this->view->setTemplate('CategoryView.tpl');
    }
}