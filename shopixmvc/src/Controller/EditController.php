<?php
declare(strict_types=1);


namespace App\Controller;

use App\Core\Container;
use App\Core\View;
use App\Model\Product\ProductRepository;
use http\Header;

class EditController implements ControllerInterface
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
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: /?page=login');
            exit;
        }

        $productId = (int)($_GET['id'] ?? '');

        if ($productId === '') {
           header('Location: /?page=admin');
        }

        $product = $this->productRepository->findByProductId($productId);

        if (isset($_POST['update'])) {
            $product->setName($_POST['name'] ?? '');
            $product->setDescription($_POST['description'] ?? '');
            $product->setPrice((float)($_POST['price'] ?? 0.0));

            $this->productRepository->updateProduct($product);
            header('Location: /?page=admin');
        }

        $this->view->addTemplateParameter('product', $product);

        $this->view->setTemplate('EditProduct.tpl');
    }
}