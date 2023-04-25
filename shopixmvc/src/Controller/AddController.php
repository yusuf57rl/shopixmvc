<?php
declare(strict_types=1);

namespace App\Controller;

use App\Core\Container;
use App\Core\Redirector;
use App\Core\View;
use App\Model\Category\CategoryMapper;
use App\Model\Category\CategoryRepository;
use App\Model\DTO\ProductDTO;
use App\Model\Product\ProductRepository;

class AddController implements ControllerInterface
{
    private View $view;
    private ProductRepository $productRepository;
    private CategoryRepository $categoryRepository;
    public Redirector $redirector;

    public function __construct(Container $container)
    {
        $this->view = $container->get(View::class);
        $this->productRepository = $container->get(ProductRepository::class);
        $this->categoryRepository = $container->get(CategoryRepository::class);
        $this->redirector = $container->get(Redirector::class);
    }

    public function load(): void
    {
        if (!isset($_SESSION['user'])) {
            $this->redirector->redirectTo('/?page=login');
            exit;
        }

        $product = new ProductDTO();
        $categories = $this->categoryRepository->findAll();

        $product->setName($_POST['name'] ?? '');
        $product->setDescription($_POST['description'] ?? '');
        $product->setPrice((float)($_POST['price'] ?? 0.0));
        $product->setCategoryid(($_POST['categoryid'] ?? 0));

        if (isset($_POST['add'])) {
            $this->productRepository->createProduct($product);
            $this->redirector->redirectTo('/?page=admin');
        }

        $this->view->addTemplateParameter('product', $product);
        $this->view->addTemplateParameter('categories', $categories);
        $this->view->setTemplate('AddProduct.tpl');
    }
}