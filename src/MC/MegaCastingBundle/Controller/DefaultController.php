<?php

namespace MC\MegaCastingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $manager = $this->getDoctrine()->getManager();
        
        $liste_domaines = $manager
                            ->getRepository('MCMegaCastingBundle:Domaine')
                            ->findAll();
 
        return $this->render('MCMegaCastingBundle:Default:index.html.twig', 
                array(  'liste_domaines' => $liste_domaines,
                        ));
    }
}
