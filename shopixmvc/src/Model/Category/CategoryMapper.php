<?php

namespace App\Model\Category;

use App\Model\DTO\CategoryDTO;

class CategoryMapper
{

    public function map(array $category): CategoryDTO
    {

        $categoryDTO = new CategoryDTO();

        $categoryDTO->setId($categoryDTO['id' ?? '']);
        $categoryDTO->setName($categoryDTO['name' ?? '']);
        $categoryDTO->setDesignation($categoryDTO['designation' ?? '']);

        return $categoryDTO;

    }
    }