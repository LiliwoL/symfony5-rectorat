<?php

namespace App\Tests\Panther;

use Symfony\Component\Panther\PantherTestCase;

class ArtistControllerTestPhpTest extends PantherTestCase
{
    public function testSomething(): void
    {
        $client = static::createPantherClient();
        $crawler = $client->request('GET', '/');

        $this->assertSelectorTextContains('h1', 'Hello World');
    }
}
