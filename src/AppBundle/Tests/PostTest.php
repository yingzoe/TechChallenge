<?php

namespace AppBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use AppBundle\DataFixtures\ORM\LoadData;

class PostTest extends WebTestCase
{
    public function testPost()
    {

        $client = static::createClient();
        $container = $client->getContainer();
        $doctrine = $container->get('doctrine');
        $em = $doctrine->getManager();
        $angelId = $em->getRepository('AppBundle:Angel')->findOneBy(array('name'=>'Lucifer'))->getId();

        $client->request(
            'POST', 
            'api/post',
            array('text' => 'Test!', 'angel' => array('id' => $angelId)),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"text":"Post from test!", "angel":{"id":'.$angelId.'}}'
        );

        $this->assertEquals(
            200, 
            $client->getResponse()->getStatusCode()
        );
        
    }

    public function setUp()
    {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager()
        ;

        $loader = new Loader();
        $loader->addFixture(new LoadData());

        $purger = new ORMPurger($this->em);
        $executor = new ORMExecutor($this->em, $purger);
        $executor->execute($loader->getFixtures());

        parent::setUp();
    }
}