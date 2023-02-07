<?php

declare(strict_types=1);

use App\Core\Container;
use App\Core\View;
require __DIR__ . "/vendor/autoload.php";


$dbConnection = new \App\Core\DatabaseConnection();
$pdo = $dbConnection->getConnection();

$container = new Container();

$dependencyprovider = new \App\Core\DependencyProvider();
$dependencyprovider->provide($container, $pdo);

$provider = new \App\Core\ControllerProvider();
$page = $_GET['page'] ?? '';

$smarty = new Smarty();

$controller = new \App\Controller\CategoriesController($container);
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

unset($pdo);