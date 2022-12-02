<?php

declare(strict_types=1);

require __DIR__ . "/vendor/autoload.php";

use App\Core\View;

$view = new View(new Smarty());
$productRepo = new \App\Model\Product\ProductRepository();
$categoryRepo = new \App\Model\Category\CategoryRepository();

$provider = new Provider();
$productRepo = new \App\Controller\ControllerProvider();

//$page = $_GET['page'] ?? '';

//if ($page === 'category') {
//    $category = new \App\Controller\CategoryController($productRepo, $view);
//    $category->load();
//} else if($page === 'product'){
//    $products = new \App\Controller\ProductController($productRepo, $view);
//    $products->load();
//} else {
//    $home = new \App\Controller\CategoriesController($categoryRepo, $view);
//    $home->load();
//}
//
//$view->display();

$controller = null;
$list = null;
foreach ($list as $key => $controllerClass) {
    if ($key === $_GET['page'] ) {
        $controller = new $controllerClass;
    }
}

$controller->display();