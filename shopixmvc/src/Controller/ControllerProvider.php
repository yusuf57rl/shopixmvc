<?php

declare(strict_types=1);

namespace App\Controller;

class ControllerProvider
{


public function getList(): array
{


return [

    "category" => DetailControll::class,
"product" => ErrorControll::class,
"home" => HomeControll::class,

    ];
}

}