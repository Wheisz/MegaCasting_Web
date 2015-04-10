<?php

namespace MC\MegaCastingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArtisteController extends Controller
{
    public function indexAction()
    {
        $manager = $this->getDoctrine()->getManager();
        
        $liste_domaines = $manager
                            ->getRepository('MCMegaCastingBundle:Domaine')
                            ->findAll();
        
        $liste_artistes = $manager
                            ->getRepository('MCMegaCastingBundle:Artiste')
                            ->findAll();
        
        return $this->render('MCMegaCastingBundle:Artiste:index.html.twig',
                array('liste_domaines' => $liste_domaines,
                        'liste_artistes' => $liste_artistes));
    }
}
