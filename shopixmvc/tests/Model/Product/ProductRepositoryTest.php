<?php

namespace App\Test\Model\Product;

use App\Model\Product\ProductMapper;
use App\Model\Product\ProductRepository;
use PHPUnit\Framework\TestCase;

class ProductRepositoryTest extends TestCase
{
    public function testFindAll(): void
    {
        $productList = new ProductRepository(new ProductMapper());
        $productList = $productList->findAll();

        self::assertCount(9, $productList);

        //product 1
        self::assertSame('Alpha T-Shirt', $productList[0]->getName());
        self::assertSame(20.0, $productList[0]->getPrice());
        self::assertSame("Alpha T-Shirt Qualität", $productList[0]->getDescription());

        self::assertSame('1', $productList[0]->getID());
    }

    public function testFindAllNegative(): void
    {
        $categoryRepository = new ProductRepository(new ProductMapper(),__DIR__ . '/productNegative.json');

        self::assertEmpty($categoryRepository->findAll());
    }
}