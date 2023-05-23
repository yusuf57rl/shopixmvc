<?php
declare(strict_types=1);

namespace App\Test\Model\Product;

use App\Core\DatabaseConnection;
use App\Model\DTO\ProductDTO;
use App\Model\Product\ProductMapper;
use App\Model\Product\ProductRepository;
use PHPUnit\Framework\TestCase;

class ProductRepositoryTest extends TestCase
{
    public function testFindAll(): void
    {
        $databaseConnection = new DatabaseConnection(testing: true);
        $pdo = $databaseConnection->getConnection();

        $productList = new ProductRepository(new ProductMapper(), $pdo);
        $productList = $productList->findAll();


        self::assertCount(7, $productList);

        //product 1
        self::assertSame('Alpha T-Shirt', $productList[0]->getName());
        self::assertSame(20.0, $productList[0]->getPrice());
        self::assertSame("Alpha T-Shirt Qualität", $productList[0]->getDescription());
        self::assertSame(1, $productList[0]->getID());
    }

    public function testFindByCategoryID(): void
    {
        $pdo = (new DatabaseConnection())->getConnection();
        $id = 1;
        $productsByCategoryID = new ProductRepository(new ProductMapper(), $pdo);
        $productList = $productsByCategoryID->findByCategoryId($id);


        self::assertCount(3, $productList);

        //product 1
        self::assertSame('Alpha T-Shirt', $productList[0]->getName());
        self::assertSame(20.0, $productList[0]->getPrice());
        self::assertSame(1, $productList[0]->getCategoryId());
        self::assertSame("Alpha T-Shirt Qualität", $productList[0]->getDescription());
        self::assertSame(1, $productList[0]->getID());
    }

    public function testFindByProductID(): void
    {

        $pdo = (new DatabaseConnection())->getConnection();
        $id = 1;

        $productRepository = new ProductRepository(new ProductMapper(), $pdo);
        $productDTO = $productRepository->findByProductId($id);

        self::assertSame('Alpha T-Shirt', $productDTO->getName());
        self::assertSame(20.0, $productDTO->getPrice());
        self::assertSame("Alpha T-Shirt Qualität", $productDTO->getDescription());
        self::assertSame($id, $productDTO->getID());
    }

    public function testUpdateProduct(): void
    {
        $databaseConnection = new DatabaseConnection(testing: true);
        $pdo = $databaseConnection->getConnection();

        // Erstellen Sie ein neues ProduktDTO-Objekt mit Testdaten
        $productDTO = new ProductDTO();
        $productDTO->setName('Test Product');
        $productDTO->setDescription('Test Description');
        $productDTO->setCategoryId(1);
        $productDTO->setPrice(9.99);

        $statement = $pdo->prepare('INSERT INTO products (name, description, categoryId, price) VALUES (:name, :description, :categoryId, :price)');
        $statement->execute([
            ':name' => $productDTO->getName(),
            ':description' => $productDTO->getDescription(),
            ':categoryId' => $productDTO->getCategoryId(),
            ':price' => $productDTO->getPrice(),
        ]);

        $id = (int) $pdo->lastInsertId();
        $productDTO->setId($id);

        $productDTO->setName('Updated Product');
        $productDTO->setDescription('Updated Description');
        $productDTO->setCategoryId(2);
        $productDTO->setPrice(19.99);

        $productRepository = new ProductRepository(new ProductMapper(), $pdo);
        $productRepository->updateProduct($productDTO);

        $statement = $pdo->prepare('SELECT * FROM products WHERE id = :id');
        $statement->execute([':id' => $id]);
        $updatedProduct = $statement->fetch();

        self::assertEquals($productDTO->getName(), $updatedProduct['name']);
        self::assertEquals($productDTO->getDescription(), $updatedProduct['description']);
        self::assertEquals($productDTO->getCategoryId(), $updatedProduct['categoryId']);
        self::assertEquals($productDTO->getPrice(), $updatedProduct['price']);

        $statement = $pdo->prepare('DELETE FROM products WHERE id = :id');
        $statement->execute([':id' => $id]);

        $statement = $pdo->prepare('SELECT * FROM products WHERE id = :id');
        $statement->execute([':id' => $id]);
        $deletedProduct = $statement->fetch();

        self::assertEmpty($deletedProduct);
    }


    public function testFindByProductIDNegativ(): void
    {

        $pdo = (new DatabaseConnection())->getConnection();

        $productRepository = new ProductRepository(new ProductMapper(), $pdo);
        $productDTO = $productRepository->findByProductId(666);

        self::assertNull($productDTO);
    }


}