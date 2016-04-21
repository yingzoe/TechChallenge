<?php

namespace AppBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GetTest extends WebTestCase
{
    /**
     * @dataProvider urlProvider
     */
    public function testGet($url)
    {
        $client = static::createClient();
        $client->request('GET', $url);

        $this->assertEquals(
            200, 
            $client->getResponse()->getStatusCode()
        );
    }

    public function urlProvider()
    {
        return array(
            array('api/angels')
        );
    }
}