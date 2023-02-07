<?php

namespace App\Model\Category;

use App\Model\DTO\CategoryDTO;

class CategoryMapper
{

    public function map(array $category): CategoryDTO
    {
        $categoryDTO = new CategoryDTO();

        $categoryDTO->setId((string)$category['ID'] ?? '');
        $categoryDTO->setName($category['name'] ?? '');
        $categoryDTO->setDesignation($category['desgination'] ?? '');

        return $categoryDTO;
    }
}