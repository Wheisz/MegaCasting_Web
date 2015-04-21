<?php

namespace MC\MegaCastingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DomaineController extends Controller
{
    public function listeAction()
    {
        $manager = $this->getDoctrine()->getManager();
        
        $liste_domaines = $manager
                            ->getRepository('MCMegaCastingBundle:Domaine')
                            ->findAll();
        
        return $this->render('MCMegaCastingBundle:Domaine:liste.html.twig',
                array('liste_domaines' => $liste_domaines));
    }
}
