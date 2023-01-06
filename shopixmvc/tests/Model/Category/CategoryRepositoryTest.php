<?php

namespace App\Test\Model\Category;

use App\Model\Category\CategoryRepository;
use PHPUnit\Framework\TestCase;

class CategoryRepositoryTest extends TestCase
{
    public function testFindAll(): void
    {
        $categoryRepository = new CategoryRepository();
        $categoryList = $categoryRepository->findAll();

        self::assertCount(3, $categoryList);

        self::assertSame('T-Shirt', $categoryList[0]['name']);
        self::assertSame('Qualitativ hochwertig', $categoryList[0]['designation']);

        self::assertSame('1', $categoryList[0]['id']);
    }

    public function testFindAllNegativ(): void
    {
        $categoryRepository = new CategoryRepository(__DIR__ . '/categoryNegativ.json');

        $this->expectException(\JsonException::class);

        $categoryRepository->findAll();
    }
}