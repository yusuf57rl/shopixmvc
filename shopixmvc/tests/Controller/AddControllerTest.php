<?php
declare(strict_types=1);

namespace App\Test\Controller;

use App\Controller\AddController;
use App\Controller\AdminController;
use App\Core\Container;
use App\Core\DatabaseConnection;
use App\Core\Redirector;
use App\Core\View;
use App\Model\Category\CategoryMapper;
use App\Model\DTO\ProductDTO;
use App\Model\Product\ProductMapper;
use App\Model\Product\ProductRepository;
use App\Model\Category\CategoryRepository;
use JetBrains\PhpStorm\NoReturn;
use PHPUnit\Framework\TestCase;
use PDO;

class AddControllerTest extends TestCase
{
    private View $view;
    private ProductRepository $productRepository;
    private AddController $addController;
    private Container $container;

    private \PDO $PDO;

    protected function setUp(): void
    {
        $dbConnection = new DatabaseConnection(testing: true);
        $pdo = $dbConnection->getConnection();

        $this->container = new Container();

        $this->productRepository = new ProductRepository(new ProductMapper(), $pdo);
        $this->container->set(ProductRepository::class, $this->productRepository);
        $this->redirector = $this->createMock(Redirector::class);

        $categoryRepository = new CategoryRepository(new CategoryMapper(), $pdo);
        $this->container->set(CategoryRepository::class, $categoryRepository);

        $this->PDO = $pdo;

        $view = new View(new \Smarty());
        $this->container->set(View::class, $view);
        $this->container->set(Redirector::class, $this->redirector);

        $this->addController = new AddController($this->container);
        $_SESSION['user'] = 'testUser';

    }
    public function testRedirectWhenSessionNotSet(): void
    {
        $this->redirector->expects($this->once())
            ->method('redirectTo')
            ->with($this->anything());

        $this->addController->load();
    }

    public function testLoadRedirectsWhenUserNotInSession(): void
    {
        unset($_SESSION['user']);

        $this->redirector->expects($this->once())
            ->method('redirectTo')
            ->with('/?page=login');

        $this->addController->load();
    }


    public function testLoadWhenSessionSetButNoPostData(): void
    {
        $_SESSION['user'] = 'testUser';

        $this->redirector->expects($this->never())
            ->method('redirectTo');

        $this->addController->load();


        $template = $this->container->get(View::class)->getTemplate();
        $this->assertEquals('AddProduct.tpl', $template);
    }

    public function testAdd(): void
    {
        ob_start();
        $productCreated = false;
        $_POST['name'] = 'test1234';
        $_POST['description'] = 'test';
        $_POST['price'] = 666.66;
        $_POST['categoryId'] = 0;

        $_POST['add'] = true;

        $this->addController->load();

        $template = $this->container->get(View::class)->getTemplate();

        $this->assertEquals('AddProduct.tpl', $template);

        $productDTOList = $this->productRepository->findAll();

        foreach ($productDTOList as $productDTO) {
            if($productDTO->getName() === 'test1234') {
                self::assertSame('test1234', $productDTO->getName());
                $productCreated = true;
                break;
            }
        }
        $this->assertTrue($productCreated, 'Product was not created.');
        ob_end_flush();
    }
    protected function tearDown(): void
    {
        parent::tearDown();
        $this->PDO->prepare('DELETE FROM products WHERE price = 666.66 OR name = "test1234";')->execute();
        unset($_SESSION['user']);
    }

}