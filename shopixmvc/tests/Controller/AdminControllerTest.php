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
use App\Core\Redirector;

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
    public function testLoadRedirectsWhenUserNotInSession(): void
    {
        unset($_SESSION['user']);

        $this->redirector->expects($this->once())
            ->method('redirectTo')
            ->with('/?page=login');

        $this->adminController->load();
    }

    public function testLoadSetsProductsWhenUserInSessionAndActionIsNotDelete(): void
    {
        // Setzen Sie die Session und GET-Variablen
        $_SESSION['user'] = 'testUser';
        $_GET['action'] = 'someOtherAction';

        $this->adminController->load();

        // Überprüfen Sie, ob das Template korrekt gesetzt ist
        $template = $this->container->get(View::class)->getTemplate();
        $this->assertEquals('Admin.tpl', $template);

        // Überprüfen Sie, ob die Produkte korrekt abgerufen wurden
        $products = $this->container->get(ProductRepository::class)->findAll();
        $this->assertNotEmpty($products);

        // Überprüfen Sie, ob die Produkte dem View-Objekt hinzugefügt wurden
        $viewProducts = $this->container->get(View::class)->getTemplateParameters()['products'];
        $this->assertEquals($products, $viewProducts);
    }


    public function testLoadRedirectsWhenActionIsDelete(): void
    {
        $_SESSION['user'] = 'testUser';
        $_GET['action'] = 'delete';
        $_GET['id'] = '1';

        $this->redirector->expects($this->once())
            ->method('redirectTo')
            ->with('/?page=admin');

        $this->adminController->load();
    }

}