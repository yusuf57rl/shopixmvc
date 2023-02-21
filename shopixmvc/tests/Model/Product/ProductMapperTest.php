<?php
declare(strict_types=1);

namespace App\Test\Model\Product;

use App\Model\DTO\ProductDTO;
use App\Model\Product\ProductMapper;
use PHPUnit\Framework\TestCase;

class ProductMapperTest extends TestCase
{
    public function testMapReturnsProductDTO()
    {
        $productList = [
            'ID' => 1,
            'name' => 'ALpha T-Shirt',
            'description' => 'Alpha T-Shirt Qualität',
            'categoryId' => 1,
            'price' => 20.00
        ];

        $productMapper = new ProductMapper();
        $productDTO = $productMapper->map($productList);

        $this->assertInstanceOf(ProductDTO::class, $productDTO);

        self::assertSame(1, $productDTO->getId());
    }

}