<?php

namespace App\Test\Model\Product;

use App\Model\Product\ProductRepository;
use PHPUnit\Framework\TestCase;

class CategoryRepositoryTest extends TestCase
{
    public function testFindAll(): void
    {
        $productList = new ProductRepository();
    $productList = $productList->findAll();

        self::assertCount(3, $productList);
        self::assertSame('1', $productList[0]['id']);
    }

    public function testFindAllNegativ(): void
    {
        $categoryRepository = new CategoryRepository(__DIR__ . '/productNegativ.json');

        $this->expectException(\JsonException::class);

        $categoryRepository->findAll();
    }
}