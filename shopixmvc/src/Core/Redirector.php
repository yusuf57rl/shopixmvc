<?php
declare(strict_types=1);

namespace App\Core;

use JetBrains\PhpStorm\NoReturn;


class Redirector
{
    #[NoReturn]
    public function redirectTo(string $url): void
    {
        $this->sendHeader('Location: ' . $url);
        exit;
    }

    protected function sendHeader(string $header): void
    {
        header($header);
    }

}