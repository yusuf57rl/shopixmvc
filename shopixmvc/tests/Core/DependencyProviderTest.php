<?php
declare(strict_types=1);

namespace App\Test\Core;

use App\Core\Container;
use App\Core\DependencyProvider;
use App\Model\Category\CategoryMapper;
use App\Model\Category\CategoryRepository;
use App\Model\Product\ProductMapper;
use App\Model\Product\ProductRepository;
use App\Core\View;
use PHPUnit\Framework\TestCase;

class DependencyProviderTest extends TestCase
{
    public function testProvideMethodAddsClassesToContainer(): void
    {
        $container = new Container();
        $dependencyProvider = new DependencyProvider();
        $dependencyProvider->provide($container);

        $objectList = $container->getList();

        self::assertInstanceOf(View::class, $objectList[View::class]);
        self::assertInstanceOf(CategoryRepository::class, $objectList[CategoryRepository::class]);
        self::assertInstanceOf(ProductRepository::class, $objectList[ProductRepository::class]);
    }
}