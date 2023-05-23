<?php
declare(strict_types=1);

namespace App\Test\Model\Category;

use App\Model\Category\CategoryMapper;
use App\Model\DTO\CategoryDTO;
use PHPUnit\Framework\TestCase;

class CategoryMapperTest extends TestCase
{
    public function testMapReturnsCategoryDTO()
    {
        $category = [
            'id' => 1,
            'name' => 'T-Shirt',
            'desgination' => 'Qualitativ hochwertig',
        ];

        $categoryMapper = new CategoryMapper();
        $categoryDTO = $categoryMapper->map($category);

        $this->assertInstanceOf(CategoryDTO::class, $categoryDTO);
    }
}
