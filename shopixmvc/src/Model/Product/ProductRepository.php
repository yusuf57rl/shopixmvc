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
            ->prepare('SELECT * FROM products WHERE ID = ' . $id);

        $statement->execute();
        $results = $statement->fetch(\PDO::FETCH_ASSOC);

        if ($results === false) {
            return null;
        }

        return $this->productMapper->map($results);
    }
}