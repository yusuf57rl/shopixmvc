<?php

namespace App\Model\Product;

class ProductRepository
{
    public function __construct(private $url = __DIR__ . '/products.json')
    {
    }
    public function findAll(): array
    {
        $products = file_get_contents($this->url);

        try {
            $productJs = json_decode($products, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $exception) {
            $productJs = [];
        }

        return $productJs;
    }

    public function findByCategoryId(string $id): array
    {
        $products = $this->findAll();

        $productsList = [];

        foreach ($products as $product) {
            if ($id === $product['categoryid']) {
                $productsList[] = $product;
            }
        }

        return $productsList;

    }

    public function findByProductId(string $id): array
    {
        $products = $this->findAll();

        foreach ($products as $product) {
            if ($id === $product['id']) {
                return $product;
            }
        }

        return [];

    }
}