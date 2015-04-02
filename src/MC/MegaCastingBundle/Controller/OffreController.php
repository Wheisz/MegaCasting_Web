<?php

namespace MC\MegaCastingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OffreController extends Controller
{
    public function indexAction()
    {
//        $manager = $this->getDoctrine()->getManager();
//        
//        $liste_offres = $manager
//                            ->getRepository('MCMegaCastingBundle:Offre')
//                            ->findBy(array(),
//                                    array('datepublication' => 'desc'), 5);
//        
//        $liste_domaines = $manager
//                            ->getRepository('MCMegaCastingBundle:Domaine')
//                            ->findAll();
//        
//        $liste_metiers = $manager 
//                            ->getRepository('MCMegaCastingBundle:Metier')
//                            ->findAll();
//        
//        
//        return $this->render('MCMegaCastingBundle:Offre:index.html.twig', 
//                array(  'liste_offres' => $liste_offres,
//                        'liste_domaines' => $liste_domaines,
//                        'liste_metiers' => $liste_metiers));
        
        // On crée un objet Advert
        $offre = new \MC\MegaCastingBundle\Entity\Offre();

        // On crée le FormBuilder grâce au service form factory
        $formBuilder = $this->get('form.factory')->createBuilder('form', $offre);

        // On ajoute les champs de l'entité que l'on veut à notre formulaire
        $formBuilder
          ->add('intitule',      'text')
          ->add('datepublication',     'date')
          ->add('iddomaine', 'entity', 
                  array(
                    'class'    => 'MCMegaCastingBundle:Domaine',
                    'property' => 'libelle',
                    'multiple' => false))
          ->add('save',      'submit')
        ;
        // Pour l'instant, pas de candidatures, catégories, etc., on les gérera plus tard

        // À partir du formBuilder, on génère le formulaire
        $form = $formBuilder->getForm();

        // On passe la méthode createView() du formulaire à la vue
        // afin qu'elle puisse afficher le formulaire toute seule
        return $this->render('MCMegaCastingBundle:Offre:index.html.twig', array(
          'form' => $form->createView(),
        ));
    }
    
    public function viewAction($id_offre)
    {
        $repository = $this->getDoctrine() 
                           ->getManager() 
                           ->getRepository('MCMegaCastingBundle:Offre'); 
        
        $offre = $repository->findOneBy(array('id' => $id_offre));
        
        return $this->render('MCMegaCastingBundle:Offre:view.html.twig', array('offre' => $offre));
    }
    
    public function domaineAction($libelle_domaine)
    {
        $domaine = $this->getDoctrine() 
                            ->getManager() 
                            ->getRepository('MCMegaCastingBundle:Domaine')
                            ->findOneBy(array('libelle' => $libelle_domaine));
        
        $offres = $this->getDoctrine() 
                            ->getManager() 
                            ->getRepository('MCMegaCastingBundle:Offre')
                            ->findBy(array('iddomaine' => $domaine->getId())); 
        
        return $this->render('MCMegaCastingBundle:Offre:index.html.twig', array('liste_offres' => $offres));
    }
    
    public function domaine_metierAction($libelle_domaine, $libelle_metier)
    {
        $domaine = $this->getDoctrine() 
                            ->getManager() 
                            ->getRepository('MCMegaCastingBundle:Domaine')
                            ->findOneBy(array('libelle' => $libelle_domaine));
        
        $metier = $this->getDoctrine() 
                            ->getManager() 
                            ->getRepository('MCMegaCastingBundle:Metier')
                            ->findOneBy(array('libelle' => $libelle_metier));
        
        $offres = $this->getDoctrine() 
                            ->getManager() 
                            ->getRepository('MCMegaCastingBundle:Offre')
                            ->findBy(array('iddomaine' => $domaine->getId(),
                                            'idmetier' => $metier->getId())); 
        
        return $this->render('MCMegaCastingBundle:Offre:index.html.twig', array('liste_offres' => $offres));
    }
    
    public function addAction()
    {
        $manager = $this->getDoctrine()->getManager();
        
        $liste_offres = $manager
                            ->getRepository('MCMegaCastingBundle:Offre')
                            ->findAll();
        
        $liste_domaines = $manager
                            ->getRepository('MCMegaCastingBundle:Domaine')
                            ->findAll();
        
        $liste_metiers = $manager 
                            ->getRepository('MCMegaCastingBundle:Metier')
                            ->findAll();
        
        
        return $this->render('MCMegaCastingBundle:Offre:add.html.twig', 
                array(  'liste_offres' => $liste_offres,
                        'liste_domaines' => $liste_domaines,
                        'liste_metiers' => $liste_metiers));
    }
}
