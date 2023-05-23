<?php
declare(strict_types=1);

namespace App\Controller;

use App\Core\Container;
use App\Core\Redirector;
use App\Core\View;
use App\Model\Product\ProductRepository;

class EditController implements ControllerInterface
{
    private View $view;
    private ProductRepository $productRepository;
    public Redirector $redirector;

    public function __construct(Container $container)
    {
        $this->view = $container->get(View::class);
        $this->productRepository = $container->get(ProductRepository::class);
        $this->redirector = $container->get(Redirector::class);
    }

    public function load(): void
    {
        if (!isset($_SESSION['user'])) {
            $this->redirector->redirectTo('/?page=login');
            return;
        }

        $productId = (int)($_GET['id'] ?? '');

        if (empty($productId)) {
            $this->redirector->redirectTo('/?page=admin');
            return;
        }

        $product = $this->productRepository->findByProductId($productId);

        if (!$product) {
            $this->redirector->redirectTo('/?page=admin');
            return;
        }

        if (isset($_POST['update'])) {
            $product->setName($_POST['name'] ?? '');
            $product->setDescription($_POST['description'] ?? '');
            $product->setPrice((float)($_POST['price'] ?? 0.0));

            $this->productRepository->updateProduct($product);
            $this->redirector->redirectTo('/?page=admin');
            return;
        }

        $this->view->addTemplateParameter('product', $product);
        $this->view->setTemplate('EditProduct.tpl');
    }
}
