<?php

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

        if ($results === false) {
            return [];
        }

        $productList = [];

        foreach ($results as $result) {
            $productList[] = $this->productMapper->map($result);
        }

        return $productList;
    }

    /**
     * @param string $id
     * @return ProductDTO[]
     */
    public function findByCategoryId(string $id): array
    {
        $products = $this->findAll();

        $productsList = [];

        foreach ($products as $product) {
            if ($id === $product->getCategoryId()) {
                $productsList[] = $product;
            }
        }

        return $productsList;

    }

    public function findByProductId(string $id)
    {
        $products = $this->findAll();

        foreach ($products as $product) {
            if ($id === $product->getId()) {
                return $product;
            }
        }

        return null;

    }
}