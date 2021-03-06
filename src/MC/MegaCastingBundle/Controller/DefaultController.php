<?php

namespace MC\MegaCastingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $manager = $this->getDoctrine()->getManager();
        
        $liste_offres = $manager
                            ->getRepository('MCMegaCastingBundle:Offre')
                            ->findBy(array(),
                                    array('datepublication' => 'desc'));
        
        $liste_artistes = $manager
                            ->getRepository('MCMegaCastingBundle:Artiste')
                            ->findBy(array(),
                                    array());
 
        return $this->render('MCMegaCastingBundle:Default:index.html.twig', 
                array(  'liste_offres' => $liste_offres,
                        'liste_artistes' => $liste_artistes
                        ));
    }
}
