<?php
declare(strict_types=1);

namespace App\Test\Core;

use App\Core\Container;
use App\Model\Category\CategoryMapper;
use App\Model\Product\ProductMapper;
use PHPUnit\Framework\TestCase;

class ContainerTest extends TestCase
{
    public function testSet(): void
    {
        $container = new Container();
        $container->set(ProductMapper::class, new ProductMapper());
        self::assertInstanceOf(ProductMapper::class, $container->get(ProductMapper::class));
    }

    public function testGetList(): void
    {
        $container = new Container();
        $container->set(ProductMapper::class, new ProductMapper());
        $container->set(CategoryMapper::class, new CategoryMapper());
        self::assertCount(2, $container->getList());

        $objectList = $container->getList();

        self::assertInstanceOf(ProductMapper::class, $objectList[ProductMapper::class]);
        self::assertInstanceOf(CategoryMapper::class, $objectList[CategoryMapper::class]);
    }
}