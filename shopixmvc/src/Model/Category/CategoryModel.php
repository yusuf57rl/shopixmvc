<?php

namespace App\Model\Category;

class CategoryModel
{
    public function clothes(): array
    {
        $categorie = file_get_contents(__DIR__ . "/../daten/category.json");
        $decodedText = html_entity_decode($categorie);
        try {
            $produktjs = json_decode($decodedText, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException) {
        }

        return array($produktjs);
    }
}