<?php
namespace App\Model\Product;

use App\Model\DTO\ProductDTO;
use App\Model\Product\ProductRepository;

class ProductMapper
{
    public function map(array $productjs): ProductDTO
    {    
        $productDTO = new ProductDTO();

        $productDTO->setId($productjs['id' ?? '']);
        $productDTO->setName($productjs['name' ?? '']);
        $productDTO->setDescription($productjs['description' ?? '']);
        $productDTO->setCategoryID($productjs['categoryid' ?? '']);
        $productDTO->setPrice($productjs("price" ?? ""));

        return $productDTO;
    }
}