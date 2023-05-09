<?php
declare(strict_types=1);

namespace App\Controller;

use App\Core\Container;
use App\Core\Redirector;
use App\Core\View;
use App\Model\DTO\ProductDTO;
use App\Model\Product\ProductRepository;
use JetBrains\PhpStorm\NoReturn;

class AdminController implements ControllerInterface
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
        if (!isset($_SESSION['user'])) {
            $this->redirector->redirectTo('/?page=login');
            return;
        }

        if (isset($_GET['action']) && $_GET['action'] === 'delete') {
            $this->productRepository->deleteProduct((int)($_GET['id'] ?? 0));
            $this->redirector->redirectTo('/?page=admin');
            return;
        }

        $products = $this->productRepository->findAll();

        $this->view->addTemplateParameter('products', $products);

        $this->view->setTemplate('Admin.tpl');
    }
}