<?php
declare(strict_types=1);


namespace App\Model\Product;


use App\Model\DTO\ProductDTO;

class ProductMapper
{
    public function map(array $productList): ProductDTO
    {    
        $productDTO = new ProductDTO();

        $productDTO->setId($productList['ID']);
        $productDTO->setName($productList['name']);
        $productDTO->setDescription($productList['description']);
        $productDTO->setCategoryID($productList['categoryId']);
        $productDTO->setPrice($productList["price"]);

        return $productDTO;
    }
}