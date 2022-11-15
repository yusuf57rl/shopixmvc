<?php

use Smarty;

class addTemplateParameterClass{

    public function addTemplateParameter(){
        $smarty = new Smarty;
        $smarty->setCaching(true);

        $smarty->assign("test", "testo");
        $smarty->display('HomeView.tpl');
    }


}