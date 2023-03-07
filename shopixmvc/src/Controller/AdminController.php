<?php
declare(strict_types=1);

namespace App\Controller;

use App\Core\Container;
use App\Core\View;
use App\Model\DTO\ProductDTO;
use App\Model\Product\ProductRepository;
use JetBrains\PhpStorm\NoReturn;

class AdminController {
private View $view;
private ProductRepository $productRepository;

public function __construct(Container $container)
{
$this->view = $container->get(View::class);
$this->productRepository = $container->get(ProductRepository::class);
}

public function load(): void {
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
header('Location: /?page=login');
exit;
}

$products = $this->productRepository->findAll();

$this->view->addTemplateParameter('products', $products);

$this->view->setTemplate('Admin.tpl');
}

public function editProduct(int $productId): void {
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
header('Location: /?page=login');
exit;
}

$product = $this->productRepository->findByProductId($productId);

$this->view->addTemplateParameter('product', $product);

$this->view->setTemplate('EditProduct.tpl');
}

    #[NoReturn]
    public function saveProduct(int $productId, string $name, string $description, int $categoryId, float $price): void {

        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: /?page=login');
            exit;
        }

        $product = new ProductDTO();
        $product->setId($productId);
        $product->setName($name);
        $product->setDescription($description);
        $product->setCategoryId($categoryId);
        $product->setPrice($price);

        $this->productRepository->updateProduct($product);

        header('Location: /?page=admin');
        exit;
    }

  #[NoReturn]
public function deleteProduct(int $productId): void {
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
header('Location: /?page=login');
exit;
}

$this->productRepository->deleteProduct($productId);

header('Location: /?page=admin');
exit;
}
}