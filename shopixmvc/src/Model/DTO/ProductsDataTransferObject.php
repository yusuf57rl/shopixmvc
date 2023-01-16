<?php
namespace \App\Model\DTO;

use App\Model\Category\CategoryRepository;
use App\Model\Product\ProductRepository;

class CategoryMapper
{
    public function map(App\Model\Product\ProductRepository $productjs): CategoryDataTransferObject
    {    
        $productDTO = new CategoryDataTransferObject();

        $productDTO->setId($productjs->getId());
        $productDTO->setName($productjs->getName());
        $productDTO->setDescription($productjs->getDescription());
        $productDTO->setCategoryID($productjs->getCategoryID());
        $productDTO->setPrice($productjs->getPrice());

        return $productDTO;
    }

        public function __construct(Article $article, User $author, array $comments)
    {
        $this->setPkId($article->getId());
        $this->setTitle($article->getTitle());
        $this->setExcerpt($article->getExcerpt());
        $this->setContent($article->getContent());
        $this->setCreatedAt($article->getCreatedAt());
        $this->setUpdatedAt($article->getUpdatedAt());
        $this->setAuthorId($article->getAuthorId());
        $this->setAuthorFirstname($author->getFirstname());
        $this->setComments($comments);
    }


}