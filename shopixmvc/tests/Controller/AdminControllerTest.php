<?php
declare(strict_types=1);

namespace App\Test\Controller;

use App\Controller\AdminController;
use App\Core\Container;
use App\Core\DatabaseConnection;
use App\Core\View;
use App\Model\DTO\ProductDTO;
use App\Model\Product\ProductMapper;
use App\Model\Product\ProductRepository;
use PHPUnit\Framework\TestCase;

class AdminControllerTest extends TestCase
{
    private Container $container;
    private AdminController $adminController;

    protected function setUp(): void
    {
        $dbConnection = new DatabaseConnection();
        $pdo = $dbConnection->getConnection();

        $this->container = new Container();

        $productRepository = new ProductRepository(new ProductMapper(), $pdo);
        $this->container->set(ProductRepository::class, $productRepository);

        $view = new View(new \Smarty());
        $this->container->set(View::class, $view);

        $this->adminController = new AdminController($this->container);

        $this->redirector = $this->createMock(Redirector::class);
        $this->container->set(Redirector::class, $this->redirector);
        $this->adminController = new AdminController($this->container);
        $this->adminController->redirector = $this->redirector;
    }

    public function testLoad(): void
    {
        $this->adminController->load();

        $template = $this->container->get(View::class)->getTemplate();

        $this->assertEquals('Admin.tpl', $template);

        $productDTO = new ProductDTO();
        $productDTO->setId(1);
        $productDTO->setName('Test Product');
        $productDTO->setDescription('A test product');
        $productDTO->setCategoryId(1);
        $productDTO->setPrice(10.0);

        $this->adminController->saveProduct(1, 'Test Product', 'A test product', 1, 10.0);

        $updatedProduct = $this->container->get(ProductRepository::class)->findByProductId(1);

        $this->assertEquals($productDTO, $updatedProduct);
    }
}