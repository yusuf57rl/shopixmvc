<?php
declare(strict_types=1);

namespace App\Test\Model\Product;

use App\Core\DatabaseConnection;
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


        self::assertCount(9, $productList);

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

    public function testFindByProductIDNegativ(): void
    {

        $pdo = (new DatabaseConnection())->getConnection();

        $productRepository = new ProductRepository(new ProductMapper(), $pdo);
        $productDTO = $productRepository->findByProductId(666);

        self::assertNull($productDTO);
    }

}