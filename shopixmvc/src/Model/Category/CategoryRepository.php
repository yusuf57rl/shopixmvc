<?php

namespace App\Model\Category;

class CategoryRepository
{
    public function __construct(private $url = __DIR__ . '/category.json')
    {
    }

    /**
     * @throws \JsonException
     */
    public function findAll(): array
    {
        $categorie = file_get_contents($this->url);
        $decodedText = html_entity_decode($categorie);

        return json_decode($decodedText, true, 512, JSON_THROW_ON_ERROR);
    }
}
