<?php

namespace App\Controller;

use App\Model\Product\ProductRepository;

class CategoryController
{
    public function __construct(private ProductRepository $productModel)
    {
    }

    public function load(): void
    {
        $categoryId = $_GET['id'] ?? '';

        $products = $this->productModel->findByCategoryId($categoryId);

        require __DIR__ . '/../View/Category.view.php';

    }
}