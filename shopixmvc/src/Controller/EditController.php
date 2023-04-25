<?php
declare(strict_types=1);


namespace App\Controller;

use App\Core\Container;
use App\Core\Redirector;
use App\Core\View;
use App\Model\Product\ProductRepository;
use http\Header;

class EditController implements ControllerInterface
{
    private View $view;
    private ProductRepository $productRepository;
    public Redirector $redirector;

    public function __construct(Container $container)
    {
        $this->view = $container->get(View::class);
        $this->productRepository = $container->get(ProductRepository::class);
    }

    public function load(): void
    {
        $productId = (int)($_GET['id'] ?? '');


        $product = $this->productRepository->findByProductId($productId);

        if (isset($_POST['update'])) {
            $product->setName($_POST['name'] ?? '');
            $product->setDescription($_POST['description'] ?? '');
            $product->setPrice((float)($_POST['price'] ?? 0.0));

            $this->productRepository->updateProduct($product);
            $this->redirector->redirectTo('/?page=admin');
        }

        $this->view->addTemplateParameter('product', $product);

        $this->view->setTemplate('EditProduct.tpl');
    }

}