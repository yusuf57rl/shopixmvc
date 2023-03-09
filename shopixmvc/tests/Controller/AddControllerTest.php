<?php
declare(strict_types=1);

namespace App\Test\Controller;

use App\Controller\AddController;
use App\Controller\AdminController;
use App\Core\Container;
use App\Core\DatabaseConnection;
use App\Core\View;
use App\Model\Category\CategoryMapper;
use App\Model\DTO\ProductDTO;
use App\Model\Product\ProductMapper;
use App\Model\Product\ProductRepository;
use App\Model\Category\CategoryRepository;
use PHPUnit\Framework\TestCase;

class AddControllerTest extends TestCase
{
    private View $view;
    private ProductRepository $productRepository;
    private AddController $addController;
    private Container $container;

    private \PDO $PDO;

    protected function setUp(): void
    {
        $dbConnection = new DatabaseConnection();
        $pdo = $dbConnection->getConnection();

        $this->container = new Container();

        $this->productRepository = new ProductRepository(new ProductMapper(), $pdo);
        $this->container->set(ProductRepository::class, $this->productRepository);

        $categoryRepository = new CategoryRepository(new CategoryMapper(), $pdo);
        $this->container->set(CategoryRepository::class, $categoryRepository);

        $view = new View(new \Smarty());
        $this->container->set(View::class, $view);

        $this->addController = new AddController($this->container);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->PDO->prepare('DELETE FROM products WHERE name = "test123"')->execute();
    }

    public function testAdd(): void
    {
        $_SESSION['user'] = ['role' => 'admin'];

        $_POST['name'] = 'test123';
        $_POST['description'] = 'test';
        $_POST['pride'] = '666.66';
        $_POST['categoryId'] = '0';

        $_POST['add'] = true;

        $this->addController->load();

        $template = $this->container->get(View::class)->getTemplate();

        $this->assertEquals('AddProduct.tpl', $template);

        $productDTOList = $this->productRepository->findAll();

        foreach ($productDTOList as $productDTO) {
            if($productDTO->getName() === 'test123') {
                self::assertSame('test123', $productDTO->getName());
            }
        }
    }
}