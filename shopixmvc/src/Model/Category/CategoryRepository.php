<?php

namespace App\Model\Category;

use App\Model\DTO\CategoryDTO;

class CategoryRepository
{
    public function __construct(
        private CategoryMapper $categorymapper,
        private readonly \PDO $PDO
    )
    {
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
