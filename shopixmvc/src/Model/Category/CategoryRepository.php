<?php

namespace App\Model\Category;

class CategoryRepository
{
    public function findAll(): array
    {
        $categorie = file_get_contents(__DIR__ . '/category.json');
        $decodedText = html_entity_decode($categorie);
        try {
            $produktjs = json_decode($decodedText, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $exception) {
            var_dump($exception);
        }

        return $produktjs;
    }
}