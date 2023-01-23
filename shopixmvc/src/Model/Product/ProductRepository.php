<?php

namespace App\Model\Product;

use App\Model\DTO\ProductDTO;
use App\Model\Product\ProductMapper;

class ProductRepository
{
    public function __construct(private ProductMapper $productMapper, private $url = __DIR__ . '/products.json')
    {
    }

    /**
     * @return ProductDTO[]
     */
    public function findAll(): array
    {
        $products = file_get_contents($this->url);

        try {
            $productsJs = json_decode($products, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $exception) {
            $productsJs = [];
        }

        $productDTOList = [];

        foreach ($productsJs as $productJs) {
            $productDTOList[] = $this->productMapper->map($productJs);
        }

        return $productDTOList;
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

    public function findByProductId(string $id): ?ProductDTO
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