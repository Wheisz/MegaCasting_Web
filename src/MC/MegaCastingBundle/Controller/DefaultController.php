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
        
        $liste_offres = $manager
                            ->getRepository('MCMegaCastingBundle:Offre')
                            ->findBy(array(),
                                    array('datepublication' => 'desc'), 5);
        
        $liste_artistes = $manager
                            ->getRepository('MCMegaCastingBundle:Artiste')
                            ->findBy(array(),
                                    array(), 5);
 
        return $this->render('MCMegaCastingBundle:Default:index.html.twig', 
                array(  'liste_domaines' => $liste_domaines,
                        'liste_offres' => $liste_offres,
                        'liste_artistes' => $liste_artistes
                        ));
    }
}
