<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Angel;
use AppBundle\Entity\Quote;

class LoadData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $angel1 = new Angel();
        $angel1->setName('Lucifer');
        $angel2 = new Angel();
        $angel2->setName('Michael');
        $angel3 = new Angel();
        $angel3->setName('Metatron');

        $quote1 = new Quote();
        $quote1->setText('I keep telling myself: no one denies that the world will ultimately be mine.')->setAngel($angel1);
              
        $quote2 = new Quote();
        $quote2->setText('Troubles fear me as long as I don’t fear them.')->setAngel($angel1); 
             
        $quote3 = new Quote();
        $quote3->setText('I keep reminding myself that I am omnipotent.')->setAngel($angel2);

        $quote4 = new Quote();
        $quote4->setText('Every brush and stroke seem to record his love through thousands of years.')->setAngel($angel3);

        $manager->persist($quote1);
        $manager->persist($quote2);
        $manager->persist($quote3);
        $manager->persist($quote4);

        $angel1->addQuote($quote1);
        $angel1->addQuote($quote2);
        $angel2->addQuote($quote3);
        $angel3->addQuote($quote4); 

        $manager->persist($angel1);
        $manager->persist($angel2);
        $manager->persist($angel3);

        $manager->flush();
    }
}