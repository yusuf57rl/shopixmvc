<?php
declare(strict_types=1);

namespace App\Test\Core;

use App\Core\View;
use PHPUnit\Framework\TestCase;

class ViewTest extends TestCase
{

    public function testSetTemplate()
    {
        $view = new View(new \Smarty());
        $view->setTemplate("test");
        self::assertSame('test.tpl', $view->getTemplate());
    }
}