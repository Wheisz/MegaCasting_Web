<?php

namespace MC\MegaCastingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

class OffreController extends Controller
{
    public function indexAction()
    {
        $manager = $this->getDoctrine()->getManager();
        
        $liste_offres = $manager
                            ->getRepository('MCMegaCastingBundle:Offre')
                            ->findBy(array(),
                                    array('datepublication' => 'desc'), 5);
        
        $liste_domaines = $manager
                            ->getRepository('MCMegaCastingBundle:Domaine')
                            ->findAll();
        
        $liste_metiers = $manager 
                            ->getRepository('MCMegaCastingBundle:Metier')
                            ->findAll();
        
        
        return $this->render('MCMegaCastingBundle:Offre:index.html.twig', 
                array(  'liste_offres' => $liste_offres,
                        'liste_domaines' => $liste_domaines,
                        'liste_metiers' => $liste_metiers));       
        
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
        $manager = $this->getDoctrine() 
                            ->getManager();
        
        $domaine = $manager
                            ->getRepository('MCMegaCastingBundle:Domaine')
                            ->findOneBy(array('libelle' => $libelle_domaine));
        
        if ($domaine == null) 
        {
            $response = new RedirectResponse($this->container->get('router')->generate('mc_mega_casting_Offre_All'));
            return $response;
        }
        
        $liste_domaines = $manager
                            ->getRepository('MCMegaCastingBundle:Domaine')
                            ->findAll();
        
        $liste_metiers = $manager 
                            ->getRepository('MCMegaCastingBundle:Metier')
                            ->findAll();
        
        $offres = $this->getDoctrine() 
                            ->getManager() 
                            ->getRepository('MCMegaCastingBundle:Offre')
                            ->findBy(array('iddomaine' => $domaine->getId())); 
        
        return $this->render('MCMegaCastingBundle:Offre:index.html.twig', array('liste_offres' => $offres,
            'liste_domaines' => $liste_domaines,
            'liste_metiers' => $liste_metiers));
    }
    
    public function domaine_metierAction($libelle_domaine, $libelle_metier)
    {
        $manager = $this->getDoctrine() 
                            ->getManager();
        
        $domaine = $manager
                            ->getRepository('MCMegaCastingBundle:Domaine')
                            ->findOneBy(array('libelle' => $libelle_domaine));       
        
        $metier = $manager 
                            ->getRepository('MCMegaCastingBundle:Metier')
                            ->findOneBy(array('libelle' => $libelle_metier));
        
        if ($domaine == null) 
        {
            $response = new RedirectResponse($this->container->get('router')->generate('mc_mega_casting_Offre_All'));
            return $response;
        }
        else
        {
            $response = new RedirectResponse($this->container->get('router')->generate('mc_mega_casting_Offre_Domaine', 
                    array('libelle_domaine' => $libelle_domaine)));
            return $response;
        }
        
        $offres = $manager 
                            ->getRepository('MCMegaCastingBundle:Offre')
                            ->findBy(array('iddomaine' => $domaine->getId(),
                                            'idmetier' => $metier->getId())); 
        
        $liste_domaines = $manager
                            ->getRepository('MCMegaCastingBundle:Domaine')
                            ->findAll();
        
        $liste_metiers = $manager 
                            ->getRepository('MCMegaCastingBundle:Metier')
                            ->findAll();
        
        return $this->render('MCMegaCastingBundle:Offre:index.html.twig', array('liste_offres' => $offres,
            'liste_domaines' => $liste_domaines,
            'liste_metiers' => $liste_metiers));
    }
    
    public function addAction()
    {
        // On crée un objet Offre
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
        return $this->render('MCMegaCastingBundle:Offre:add.html.twig', array(
          'form' => $form->createView(),
        ));
    }
}
