<?php

namespace Ivan\CreditCalcBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/calc');

        $this->assertContains('Credit calculator', $client->getResponse()->getContent());
    }
}
