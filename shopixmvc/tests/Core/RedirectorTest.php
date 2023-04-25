<?php
declare(strict_types=1);

namespace App\Test\Core;

use App\Core\Redirector;
use PHPUnit\Framework\TestCase;

class RedirectorTest extends TestCase
{
    private Redirector $redirector;

    protected function setUp(): void
    {
        $this->redirector = new Redirector();
        ob_start();
    }

    protected function tearDown(): void
    {
        ob_end_clean();
    }

    /**
     * @runInSeparateProcess
     */
    public function testRedirectTo(): void
    {
        $pageURL = 'login';
        $reflector = new \ReflectionClass(Redirector::class);

        // Get the redirectTo method
        $method = $reflector->getMethod('redirectTo');

        // Make the redirectTo method accessible
        $method->setAccessible(true);

        // Execute the redirectTo method with a custom header function
        $method->invokeArgs($this->redirector,
            ['/?page=login',
            function ($header) {
                echo $header;
            }
        ]);

        $output = ob_get_contents();

        ob_end_clean();

        $this->assertStringContainsString('Location: /?page='.$pageURL, $output, 'Location header not found');
    }
}
