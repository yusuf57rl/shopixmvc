<?php
declare(strict_types=1);

namespace App\Controller;

use App\Core\Container;
use App\Core\View;
use App\Model\Category\CategoryRepository;

class CategoriesController implements ControllerInterface
{
    private View $view;
    private CategoryRepository $categoryRepository;

    public function __construct(Container $container)
    {
        $this->view = $container->get(View::class);
        $this->categoryRepository = $container->get(CategoryRepository::class);
    }

    public function load(): void
    {
        $categories = $this->categoryRepository->findAll();

        $this->view->addTemplateParameter('categories', $categories);
        $this->view->setTemplate('HomeView.tpl');
    }
}