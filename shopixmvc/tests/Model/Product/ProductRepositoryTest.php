<?php

namespace App\Test\Model\Product;

use App\Model\Product\ProductRepository;
use PHPUnit\Framework\TestCase;

class ProductRepositoryTest extends TestCase
{
    public function testFindAll(): void
    {
        $productList = new ProductRepository();
        $productList = $productList->findAll();

        self::assertCount(9, $productList);

        //product 1
        self::assertSame('Alpha T-Shirt', $productList[0]['name']);
        self::assertSame(20.0, $productList[0]['price']);
        self::assertSame("Alpha T-Shirt Qualität", $productList[0]['description']);

        self::assertSame('1', $productList[0]['id']);
    }

    public function testFindAllNegative(): void
    {
        $categoryRepository = new ProductRepository(__DIR__ . '/productNegative.json');


        self::assertEmpty($categoryRepository->findAll());
    }
}