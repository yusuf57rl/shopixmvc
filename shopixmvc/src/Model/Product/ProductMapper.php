<?php
namespace App\Model\Product;

use App\Model\DTO\ProductDTO;
use App\Model\Product\ProductRepository;

class ProductMapper
{
    public function map(array $productList): ProductDTO
    {    
        $productDTO = new ProductDTO();

        $productDTO->setId((int)$productList['ID'] ?? '');
        $productDTO->setName($productList['name']  ?? '');
        $productDTO->setDescription($productList['description'] ?? '');
        $productDTO->setCategoryID((string)$productList['categoryId']?? '');
        $productDTO->setPrice((float)($productList["price"] ?? ""));

        return $productDTO;
    }
}