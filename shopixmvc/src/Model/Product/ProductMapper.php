<?php
namespace App\Model\Product;

use App\Model\DTO\ProductDTO;
use App\Model\Product\ProductRepository;

class ProductMapper
{
    public function map(array $productList): ProductDTO
    {    
        $productDTO = new ProductDTO();

        $productDTO->setId((string)$productList['id'] ?? '');
        $productDTO->setName($productList['name']  ?? '');
        $productDTO->setDescription($productList['description'] ?? '');
        $productDTO->setCategoryID($productList['categoryid']?? '');
        $productDTO->setPrice((float)($productList["price"] ?? ""));

        return $productDTO;
    }
}