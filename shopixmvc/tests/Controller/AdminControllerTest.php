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

    private ProductRepository $productRepository;
    private AdminController $adminController;

    protected function setUp(): void
    {
        $dbConnection = new DatabaseConnection(testing: true);
        $pdo = $dbConnection->getConnection();

        $this->container = new Container();

        $this->productRepository = new ProductRepository(new ProductMapper(), $pdo);  // Hier initialisiere ich die $this->productRepository Eigenschaft
        $this->container->set(ProductRepository::class, $this->productRepository);

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
        $productDTO->setName('Test Product');
        $productDTO->setDescription('A test product');
        $productDTO->setCategoryId(1);
        $productDTO->setPrice(10.0);

        $this->productRepository->createProduct('Test Product', 'A test product', 999, 10.0);

        $updatedProduct = $this->container->get(ProductRepository::class)->findByCategoryId(999);

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
        $_SESSION['user'] = 'testUser';
        $_GET['action'] = 'someOtherAction';

        $this->adminController->load();

        $template = $this->container->get(View::class)->getTemplate();
        $this->assertEquals('Admin.tpl', $template);

        $products = $this->container->get(ProductRepository::class)->findAll();
        $this->assertNotEmpty($products);

        $viewProducts = $this->container->get(View::class)->getTemplateParameter('products');
        $this->assertEquals($products, $viewProducts);
    }



    public function testLoadRedirectsWhenActionIsDelete(): void
    {

        $_SESSION['user'] = 'testUser';
        $_GET['action'] = 'delete';
        $_GET['id'] = '999';

        $this->redirector->expects($this->once())
            ->method('redirectTo')
            ->with('/?page=admin');

        $this->adminController->load();
    }



}