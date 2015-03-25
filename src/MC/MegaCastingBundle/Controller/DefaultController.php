<?php

namespace MC\MegaCastingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        $entreprises = $this->getDoctrine() 
                           ->getManager() 
                           ->getRepository('MCMegaCastingBundle:Typecontrat'); 
        
        $listeEntreprises = $entreprises->findOneBy(array('id' => 1));
        
        $name = $listeEntreprises->getLibelle();
        
        return $this->render('MCMegaCastingBundle:Default:index.html.twig', array('name' => $name));
    }
}
