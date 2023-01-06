<?php
declare(strict_types=1);

namespace App\Controller;

use App\Core\Container;
use App\Core\View;
use App\Model\Category\CategoryRepository;

class HomeController implements ControllerInterface
{
    private View $view;

    public function __construct(Container $container)
    {
        $this->view = $container->get(View::class);
    }

    public function load(): void
    {

        $this->view->setTemplate('Home.tpl');
    }
}