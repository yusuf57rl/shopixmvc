<?php

declare(strict_types=1);

require __DIR__ . "/vendor/autoload.php";

$container = new \App\Core\Container();


$dependencyprovider = new \App\Core\DependencyProvider();
$dependencyprovider->provide($container);

$provider = new \App\Core\ControllerProvider();
$page = $_GET["page"] ?? "";

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

$controller = new \App\Controller\CategoryController($container);

foreach ($provider->getList() as $key => $controllerClass) {
    if ($key == $page ) {
        $controller = new $controllerClass($container);
    break;
    }
}


$controller->load();
