<?php

namespace App\Controller;

use App\Core\Container;
use App\Core\View;
use App\Model\Product\ProductRepository;

class ProductController implements ControllerInterface
{
    private View $view;
    private ProductRepository $productRepository;

    public function __construct(Container $container)
    {
        $this->view = $container->get(View::class);
        $this->productRepository = $container->get(ProductRepository::class);
    }

    public function load(): void
    {
        $productId = $_GET['id'] ?? '';

        $product = $this->productRepository->findByProductId($productId);
        $this->view->addTemplateParameter('product', $product);
        $this->view->setTemplate('ProductView.tpl');

    }
}
