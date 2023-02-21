<?php
declare(strict_types=1);

namespace App\Controller;

use App\Core\Container;
use App\Core\View;
use App\Model\Category\CategoryRepository;
use App\Model\Product\ProductRepository;

class CategoryController  implements ControllerInterface
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
        $categoryId = (int)($_GET['id'] ?? '');

        $products = $this->productRepository->findByCategoryId($categoryId);

        $this->view->addTemplateParameter('products', $products);
        $this->view->setTemplate('CategoryView.tpl');
    }
}