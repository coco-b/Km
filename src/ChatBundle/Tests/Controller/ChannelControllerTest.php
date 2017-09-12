<?php

namespace ChatBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ChannelControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/index');
    }

    public function testAddchannel()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/AddChannel');
    }

}
