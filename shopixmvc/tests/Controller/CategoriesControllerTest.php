<?php

namespace App\Test\Controller;

use App\Controller\CategoriesController;
use App\Core\View;
use PHPUnit\Framework\TestCase;

class CategoriesControllerTest extends TestCase
{
    public function ():
    {
        $categories = new CategoriesController();
        $categories = $categories->();


        self::assertCount(3, $parameter);
        self::assertSame('', );
    }

    public function testFindAllNegativ(): void
    {
        $categoryRepository = new CategoryRepository(__DIR__ . '/categoryNegativ.json');

        $this->expectException(\JsonException::class);

        $categoryRepository->findAll();
    }
}