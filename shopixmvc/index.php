<?php

declare(strict_types=1);

use App\Core\Container;
use App\Core\View;
require __DIR__ . "/vendor/autoload.php";

session_start();

$dbConnection = new \App\Core\DatabaseConnection();
$pdo = $dbConnection->getConnection();

$container = new Container();

$smarty = new Smarty();
$smarty->setTemplateDir(__DIR__ . '/template');
$smarty->setCompileDir(__DIR__ . '/smarty/template_c');
$smarty->setCacheDir(__DIR__ . '/smarty/cache');
$smarty->setConfigDir(__DIR__ . '/smarty/config');

$dependencyprovider = new \App\Core\DependencyProvider();
$dependencyprovider->provide($container, $pdo, $smarty);

$provider = new \App\Core\ControllerProvider();
$page = $_GET['page'] ?? '';



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

$dbConnection->closeConnection($pdo);

//session_destroy(); TODO in logout controller