<?php

namespace App\Controller;


class GetController
{

public function geta()
{
    $categories = array('1' => 'Jacken','2' => 'Hosen','3' =>'T-Shirts', '4' => 'Error');

    $categoryid = $_GET["categoryid"];
    $category = "";


    if($categoryid === 1){
$category = $categories[1];
    }
else if($categoryid === 2){
    $category = $categories[2];
}
    else if($categoryid === 3){
        $category = $categories[3];
    }
    else {
        $category = $categories[4];
    }
    return $category;
}


}