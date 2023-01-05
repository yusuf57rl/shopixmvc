<?php

namespace App\Test\Model\Core;

use App\Core\View;
use PHPUnit\Framework\TestCase;

class ViewTest extends TestCase
{
    public function testaddTemplateParameter(): void
    {
        $parameter = new View();
    $parameter = $parameter->addTemplateParameter();

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