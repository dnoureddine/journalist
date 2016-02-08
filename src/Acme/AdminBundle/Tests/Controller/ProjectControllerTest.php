<?php

namespace Acme\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjectControllerTest extends WebTestCase
{
    public function testProjects()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'projects');
    }

}
