<?php

namespace App\Model\Category;

use App\Model\DTO\CategoryDTO;

class CategoryRepository
{
    public function __construct(private CategoryMapper $categorymapper, private $url = __DIR__ . '/category.json')
    {
    }

    /**
     * @return CategoryDTO[]
     */
    public function findAll(): array
    {
        $category = file_get_contents($this->url);

        try {
            $categoriesJs = json_decode($category, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $exception) {
            $categoriesJs = [];
        }

        $categoryDTOList = [];

        foreach ($categoriesJs as $categoryJs) {
            $categoryDTOList[] = $this->categorymapper->map($categoryJs);
        }

        return $categoryDTOList;
    }
}
