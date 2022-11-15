<?php

declare(strict_types=1);

require __DIR__ . "/vendor/autoload.php";


$productRepo = new \App\Model\Product\ProductRepository();
$categoryRepo = new \App\Model\Category\CategoryRepository();

$page = $_GET['page'] ?? '';

if ($page === 'category') {
    $category = new \App\Controller\CategoryController($productRepo);
    $category->load();
} else if($page === 'product'){
    $products = new \App\Controller\ProductController($productRepo);
    $products->load();
} else {
    $category = new \App\Controller\CategoriesController($categoryRepo);
    $category->load();
}
