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
 
        return $this->render('::base.html.twig', 
                array(  'liste_domaines' => $liste_domaines,
                        ));
    }
}
