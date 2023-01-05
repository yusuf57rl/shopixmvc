<?php

declare(strict_types=1);

require __DIR__ . "/vendor/autoload.php";

$container = new \App\Core\Container();


$dependencyprovider = new \App\Core\DependencyProvider();
$dependencyprovider->provide($container);

$provider = new \App\Core\ControllerProvider();
$page = $_GET["page"] ?? "";

$controller = new \App\Controller\CategoryController($container);

foreach ($provider->getList() as $key => $controllerClass) {
    if ($key === $page) {
        $controllerCheck = new $controllerClass($container);
        if($controllerCheck instanceof \App\Controller\ControllerInterface){
            $controller = $controllerCheck;
            break;
        }
    }
}


$controller->load();
