<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MovieControllerTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/movie/list');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Liste des films');
    }
}
