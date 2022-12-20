<?php

namespace App\Test\Model\Product;

use App\Model\Product\ProductRepository;
use PHPUnit\Framework\TestCase;

class CategoryRepositoryTest extends TestCase
{
    public function testFindAll(): void
    {
        $categoryRepository = new CategoryRepository();$categoryList =
    $categoryList = $categoryRepository->findAll();

        self::assertCount(3, $categoryList);
        self::assertSame('1', $categoryList[0]['id']);
    }

    public function testFindAllNegativ(): void
    {
        $categoryRepository = new CategoryRepository(__DIR__ . '/categoryNegativ.json');

        $this->expectException(\JsonException::class);

        $categoryRepository->findAll();
    }
}