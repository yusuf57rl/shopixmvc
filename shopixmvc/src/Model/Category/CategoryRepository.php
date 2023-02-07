<?php

namespace App\Model\Category;

use App\Model\DTO\CategoryDTO;

class CategoryRepository
{
    public function __construct(
        private CategoryMapper $categorymapper,
        private \PDO $PDO,
        private $url = __DIR__ . '/category.json',
    )
    {
    }

    /**
     * @return CategoryDTO[]
     * @deprecated
     */
    public function findAllFromJson(): array
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

    /**
     * @return CategoryDTO[]
     */
    public function findAll(): array
    {
        $statement = $this->PDO
            ->prepare('SELECT * FROM categories');

        $statement->execute();

        $results = $statement
            ->fetchAll(\PDO::FETCH_ASSOC);

        if ($results === false) {
            return [];
        }

        $categoryList = [];

        foreach ($results as $result) {
            $categoryList[] = $this->categorymapper->map($result);
        }

        return $categoryList;
    }
}
