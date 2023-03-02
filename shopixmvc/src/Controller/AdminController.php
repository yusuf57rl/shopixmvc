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
// Überprüfen, ob der Benutzer Admin-Rechte hat
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
header('Location: /?page=login');
exit;
}

// Produkte aus der Datenbank abrufen
$products = $this->productRepository->findAll();

// Die Produktliste an die Smarty-Vorlage übergeben
$this->view->addTemplateParameter('products', $products);

// Die Smarty-Vorlage für die Admin-Seite festlegen
$this->view->setTemplate('Admin.tpl');
}

public function editProduct(int $productId): void {
// Überprüfen, ob der Benutzer Admin-Rechte hat
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
header('Location: /?page=login');
exit;
}

// Das zu bearbeitende Produkt aus der Datenbank abrufen
$product = $this->productRepository->findByProductId($productId);

// Das Produkt an die Smarty-Vorlage übergeben
$this->view->addTemplateParameter('product', $product);

// Die Smarty-Vorlage für die Editier-Seite festlegen
$this->view->setTemplate('EditProduct.tpl');
}

    #[NoReturn]
    public function saveProduct(int $productId, string $name, string $description, int $categoryId, float $price): void {
        // Überprüfen, ob der Benutzer Admin-Rechte hat
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: /?page=login');
            exit;
        }

        // Ein neues ProductDTO-Objekt mit den übergebenen Daten erstellen
        $product = new ProductDTO();
        $product->setId($productId);
        $product->setName($name);
        $product->setDescription($description);
        $product->setCategoryId($categoryId);
        $product->setPrice($price);

        // Das Produkt in der Datenbank aktualisieren
        $this->productRepository->updateProduct($product);

        // Zurück zur Admin-Seite umleiten
        header('Location: /?page=admin');
        exit;
    }

  #[NoReturn]
public function deleteProduct(int $productId): void {
// Überprüfen, ob der Benutzer Admin-Rechte hat
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
header('Location: /?page=login');
exit;
}

// Das Produkt aus der Datenbank löschen
$this->productRepository->deleteProduct($productId);

// Zurück zur Admin-Seite umleiten
header('Location: /?page=admin');
exit;
}
}