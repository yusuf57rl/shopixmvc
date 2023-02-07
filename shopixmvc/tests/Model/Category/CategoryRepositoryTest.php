<?php

namespace App\Test\Model\Category;

use App\Core\DatabaseConnection;
use App\Model\Category\CategoryMapper;
use App\Model\Category\CategoryRepository;
use App\Model\Product\ProductRepository;
use PHPUnit\Framework\TestCase;

class CategoryRepositoryTest extends TestCase
{
    public function testFindAll(): void
    {
        $pdo = (new DatabaseConnection())->getConnection();

        $categoryRepository = new CategoryRepository(new CategoryMapper(), $pdo);
        $categoryList = $categoryRepository->findAll();

        self::assertCount(3, $categoryList);

        self::assertSame("1", $categoryList[0]->getId());
        self::assertSame("2", $categoryList[1]->getId());
        self::assertSame("3", $categoryList[2]->getId());

        self::assertSame('T-Shirt', $categoryList[0]->getName());
        self::assertSame('Jacken', $categoryList[1]->getName());
        self::assertSame("Hosen", $categoryList[2]->getName());

        self::assertSame('Qualitativ hochwertig', $categoryList[0]->getDesignation());
        self::assertSame('100% Baumwolle', $categoryList[1]->getDesignation());
        self::assertSame("Elastisch", $categoryList[2]->getDesignation());
    }

   // public function testFindAllNegative(): void
    //{
    //    $categoryRepository = new CategoryRepository(new CategoryMapper(), __DIR__ . '/categoryNegative.json');
//
//
    //      self::assertEmpty($categoryRepository->findAllFromJson());
    // }
}