<?php

namespace App\core;
use App\Model\Category\CategoryRepository;
use Smarty;
use App\Controller\CategoriesController;


class view{

    public function addTemplateParameter($categories2){


        $smarty = new Smarty;
        $smarty->setCaching(true);

        $category = new CategoriesController(CategoryRepository::class);
        $category->load($categories2);

        $smarty->assign("test", $categories2);
        $smarty->display('HomeView.tpl');

    }

    public function display(){


    }


}


