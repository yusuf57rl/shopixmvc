<?php

declare(strict_types=1);

use App\Core\Container;
use App\Core\View;

require __DIR__ . "/vendor/autoload.php";

$container = new Container();


$dependencyprovider = new \App\Core\DependencyProvider();
$dependencyprovider->provide($container);

$provider = new \App\Core\ControllerProvider();
$page = $_GET['page'] ?? '';

$smarty = new Smarty();

$controller = new \App\Controller\CategoryController($container);
foreach ($provider->getList() as $key => $controllerClass) {
    if ($key === $page) {
        $controllerCheck = new $controllerClass($container);
        if ($controllerCheck instanceof \App\Controller\ControllerInterface) {
            $controller = $controllerCheck;

            break;
        }
    }
}

$controller->load();
$container->get(View::class)->display();