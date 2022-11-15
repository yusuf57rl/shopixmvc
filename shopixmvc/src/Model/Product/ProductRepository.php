<?php

namespace App\Model\Product;

class ProductRepository
{
    public function findAll(): array
    {
        $products = file_get_contents(__DIR__ . "/products.json");
        $decodedText = html_entity_decode($products);

        try {
            $productJs = json_decode($decodedText, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $exception) {
            var_dump($exception);
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