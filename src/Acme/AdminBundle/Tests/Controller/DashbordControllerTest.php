<?php

namespace Acme\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DashbordControllerTest extends WebTestCase
{
    public function testDashbord()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/dashbord');
    }

}
