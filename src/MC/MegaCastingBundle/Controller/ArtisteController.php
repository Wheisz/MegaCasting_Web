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
    
    public function viewAction($id_artiste)
    {
        $manager = $this->getDoctrine() 
                           ->getManager();
                            
        
        $liste_domaines = $manager
                            ->getRepository('MCMegaCastingBundle:Domaine')
                            ->findAll();
        
        $artiste = $manager
                ->getRepository('MCMegaCastingBundle:Artiste')
                ->findOneBy(array('id' => $id_artiste));
        
        return $this->render('MCMegaCastingBundle:Artiste:view.html.twig', 
                array('artiste' => $artiste,
                    'liste_domaines' => $liste_domaines));
    }
    
    public function domaineAction($libelle_domaine)
    {
        $manager = $this->getDoctrine()->getManager();
        
        $liste_domaines = $manager
                            ->getRepository('MCMegaCastingBundle:Domaine')
                            ->findAll();
          
        $liste_artistes = $manager
                            ->getRepository('MCMegaCastingBundle:Artiste')
                            ->myFindByDomaine($libelle_domaine);

        return $this->render('MCMegaCastingBundle:Artiste:index.html.twig',
                array('liste_domaines' => $liste_domaines,
                        'liste_artistes' => $liste_artistes));
    }
}
