<?php
declare(strict_types=1);

namespace App\Controller;

interface ControllerInterface
{
    public function load(): void;
}