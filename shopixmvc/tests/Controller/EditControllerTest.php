<?php
declare(strict_types=1);

namespace App\Test\Controller;

use App\Controller\EditController;
use App\Core\Container;
use App\Core\Redirector;
use App\Core\View;
use App\Model\DTO\ProductDTO;
use App\Model\Product\ProductRepository;
use PHPUnit\Framework\TestCase;

class EditControllerTest extends TestCase
{
    private EditController $editController;
    private Container $container;
    private View $view;
    private ProductRepository $productRepository;
    private Redirector $redirector;

    protected function setUp(): void
    {
        $_GET = [];
        $_POST = [];

        $this->view = $this->createMock(View::class);
        $this->productRepository = $this->createMock(ProductRepository::class);
        $this->redirector = $this->createMock(Redirector::class);

        $this->container = new Container();
        $this->container->set(View::class, $this->view);
        $this->container->set(ProductRepository::class, $this->productRepository);
        $this->container->set(Redirector::class, $this->redirector);

        $this->editController = new EditController($this->container);
        $this->editController->redirector = $this->redirector;
    }


    public function testLoad(): void
    {
        $_SESSION['user'] = ['role' => 'admin'];

        // Define a sample product to be returned by the mock ProductRepository
        $sampleProduct = new ProductDTO();
        $sampleProduct->setId(1);
        $sampleProduct->setName('Test Product');
        $sampleProduct->setDescription('Test Description');
        $sampleProduct->setPrice(99.99);

        $this->productRepository->method('findByProductId')->willReturn($sampleProduct);

        // Define expected updated product values
        $updatedName = 'Updated Test Product';
        $updatedDescription = 'Updated Test Description';
        $updatedPrice = 123.45;

        // Define $_GET and $_POST values for the test
        $_GET['id'] = '1';
        $_POST['update'] = true;
        $_POST['name'] = $updatedName;
        $_POST['description'] = $updatedDescription;
        $_POST['price'] = (string)$updatedPrice;

        $this->productRepository->expects($this->once())
            ->method('updateProduct')
            ->with($this->callback(function ($product) use ($updatedName, $updatedDescription, $updatedPrice) {
                return $product->getName() === $updatedName
                    && $product->getDescription() === $updatedDescription
                    && $product->getPrice() === $updatedPrice;
            }));

        $this->view->expects($this->once())
            ->method('setTemplate')
            ->with('EditProduct.tpl');

        $this->editController->load();
    }
    public function testLoad_NotLoggedIn(): void
    {
        unset($_SESSION['user']);

        $this->redirector->expects($this->once())
            ->method('redirectTo')
            ->with('/?page=login');

        $this->editController->load();
    }


    public function testLoadRedirectsToAdminPageWhenProductIdIsEmpty(): void
    {
        $_GET['id'] = '';

        $this->redirector->expects($this->once())
            ->method('redirectTo')
            ->with($this->equalTo('/?page=admin'));

        $this->editController->load();
    }

    public function testLoadUpdatesProductAndRedirectsToAdminPage()
    {
        $_GET['id'] = '1';
        $_POST['update'] = true;
        $_POST['name'] = 'Updated Name';
        $_POST['description'] = 'Updated Description';
        $_POST['price'] = '99.99';

        $productMock = $this->createMock(ProductDTO::class);
        $this->productRepository->expects($this->once())
            ->method('findByProductId')
            ->with($this->equalTo(1))
            ->willReturn($productMock);

        $this->productRepository->expects($this->once())
            ->method('updateProduct')
            ->with($this->equalTo($productMock));

        $this->editController->load();
        $this->redirector->expects($this->once())
            ->method('redirectTo')
            ->with($this->equalTo('/?page=admin'));
    }
    public function testLoad_NoProductId(): void
    {
        $_SESSION['user'] = ['role' => 'admin'];
        $_GET['id'] = '';

        $this->redirector->expects($this->once())
            ->method('redirectTo')
            ->with('/?page=admin');

        $this->editController->load();
    }

    public function testLoad_ProductDoesNotExist(): void
    {
        $_SESSION['user'] = ['role' => 'admin'];
        $_GET['id'] = '1';

        $this->productRepository->method('findByProductId')->willReturn(null);

        $this->redirector->expects($this->once())
            ->method('redirectTo')
            ->with('/?page=admin');

        $this->editController->load();
    }
    public function testLoad_UpdateWithoutRequiredPostData(): void
    {
        $_SESSION['user'] = ['role' => 'admin'];
        $_GET['id'] = '1';
        $_POST['update'] = true;
        $_POST['name'] = '';
        $_POST['description'] = 'Updated Description';
        $_POST['price'] = '99.99';

        $this->productRepository->expects($this->never())
            ->method('updateProduct');

        $this->editController->load();
    }

    public function testLoad_UpdateWithInvalidPostData(): void
    {
        $_SESSION['user'] = ['role' => 'admin'];
        $_GET['id'] = '1';
        $_POST['update'] = true;
        $_POST['name'] = 'Updated Name';
        $_POST['description'] = 'Updated Description';
        $_POST['price'] = 'invalid';

        $this->productRepository->expects($this->never())
            ->method('updateProduct');

        $this->editController->load();
    }

    public function testLoad_ProductNotUpdated(): void
    {
        $_SESSION['user'] = ['role' => 'admin'];
        $_GET['id'] = '1';
        // Do not set $_POST['update'].
        $_POST['name'] = 'Updated Name';
        $_POST['description'] = 'Updated Description';
        $_POST['price'] = '99.99';

        $productMock = $this->createMock(ProductDTO::class);
        $this->productRepository->expects($this->once())
            ->method('findByProductId')
            ->with($this->equalTo(1))
            ->willReturn($productMock);

        $this->productRepository->expects($this->never())
            ->method('updateProduct');

        $this->editController->load();
    }

    protected function tearDown(): void
    {

        $_SESSION = [];
        $_GET = [];
        $_POST = [];
    }

}
