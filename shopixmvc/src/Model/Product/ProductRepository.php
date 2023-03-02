<?php

declare(strict_types=1);

namespace App\Model\Product;

use App\Model\DTO\ProductDTO;
use App\Model\Product\ProductMapper;

class ProductRepository
{
    public function __construct(
        private readonly ProductMapper $productMapper,
        private readonly \PDO          $PDO
    )
    {
    }

    public function findAll(): array
    {
        $statement = $this->PDO
            ->prepare('SELECT * FROM products');
        $statement->execute();

        $results = $statement
            ->fetchAll(\PDO::FETCH_ASSOC);

        $productList = [];

        foreach ($results as $result) {
            $productList[] = $this->productMapper->map($result);
        }

        return $productList;
    }

    /**
     * @param int $id
     * @return ProductDTO[]
     */
    public function findByCategoryId(int $id): array
    {
        $statement = $this->PDO
            ->prepare('SELECT * FROM products WHERE categoryId = ' . $id);

        $statement->execute();
        $results = $statement->fetchAll(\PDO::FETCH_ASSOC);

        $productsList = [];

        foreach ($results as $product) {
            $productsList[] = $this->productMapper->map($product);
        }

        return $productsList;
    }

    public function findByProductId(int $id): ?ProductDTO
    {
        $statement = $this->PDO
            ->prepare('SELECT * FROM products WHERE id = :id');
        $statement->execute(['id' => $id]);

        $result = $statement->fetch(\PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        return $this->productMapper->map($result);
    }

    public function updateProduct(ProductDTO $productDTO): void
    {
        $statement = $this->PDO->prepare('UPDATE products SET name = :name, description = :description, categoryId = :categoryId, price = :price WHERE id = :id');

        $statement->bindValue(':id', $productDTO->getId(), \PDO::PARAM_INT);
        $statement->bindValue(':name', $productDTO->getName(), \PDO::PARAM_STR);
        $statement->bindValue(':description', $productDTO->getDescription(), \PDO::PARAM_STR);
        $statement->bindValue(':categoryId', $productDTO->getCategoryId(), \PDO::PARAM_INT);
        $statement->bindValue(':price', $productDTO->getPrice(), \PDO::PARAM_STR);

        $statement->execute();
    }

    public function deleteProduct(int $id): void
    {
        $statement = $this->PDO->prepare('DELETE FROM products WHERE id = :id');

        $statement->execute([
            'id' => $id
        ]);
    }
}