<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Quote;
use AppBundle\Entity\Angel;


class MainController extends Controller
{
    /**
     * @Route("/api/angels", requirements={"_format" : "json"})
     * @Method({"GET"})
     */
    public function getDataAction()
    {
        $em = $this->getDoctrine()->getManager();
        $angelsFromDoctrine = $em->getRepository('AppBundle:Angel')->findAll();

        $angels = array();
        
        foreach ($angelsFromDoctrine as $angel) {
            $quotes = array();
            $quotesArray = $angel->getQuotes();
            foreach ($quotesArray as $quote) {
                array_push($quotes, array(
                    'id' => $quote->getId(), 
                    'text' => $quote->getText(),
                    'createdAt' => $quote->getCreatedAt()
                ));  
            }

            $angels[$angel->getId()] = array(
                'id' => $angel->getId(),
                'name' => $angel->getName(),
                'quotes' => $quotes
            );
        }

        return new JsonResponse($angels);
    }

    /**
     * @Route("/api/quotes", requirements={"_format" : "json"})
     * @Method({"GET"})
     */
    /*public function getQuotesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $quotesFromDoctrine = $em->getRepository('AppBundle:Quote')->findAll();

        $quotes = array();
        
        foreach ($quotesFromDoctrine as $quote) {
            $quotes[$quote->getId()] = array(
                'id' => $quote->getId(),
                'text' => $quote->getText(),
                'createdAt' => $quote->getCreatedAt(),
                'angel' => $quote->getAngel()
            );
        }

        return new JsonResponse($quotes);
    }*/

    /**
     * @Route("/api/post")
     */
    public function insertQuoteAction(Request $request)
    {
        
        $data = json_decode($request->getContent(), true);

        $request->request->replace($data);

        $em = $this->getDoctrine()->getManager();

        $quote = new Quote();
        $quote->setText($request->request->get('text'));
        $em->persist($quote);

        $selectAngel = $em->getRepository('AppBundle:Angel')->findOneBy(array('id'=>$request->request->get('angel')['id']));
        $quote->setAngel($selectAngel);
        $em->persist($selectAngel);

        $em->flush();

        $newQuote = array();
        array_push($newQuote, array(
            'angelId' => $selectAngel->getId(), 
            'angelName' => $selectAngel->getName(),
            'createdAt' => $quote->getCreatedAt(),
            'id' => $quote->getId(),
            'text' => $quote->getText()
        )); 

        return new JsonResponse($newQuote);
    }
}