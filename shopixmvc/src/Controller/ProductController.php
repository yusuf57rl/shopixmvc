<?php

namespace App\Controller;

use App\Model\Product\ProductRepository;

class ProductController
{
    public function __construct(private ProductRepository $productRepository)
    {
    }

    public function load(): void
    {
        $productId = $_GET['id'] ?? '';

       $product = $this->productRepository->findByProductId($productId);
        require __DIR__ . "/../View/Product.view.php";
    }
}
