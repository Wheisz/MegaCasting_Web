<?php

namespace MC\MegaCastingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use MC\MegaCastingBundle\Entity\Offre;
use MC\MegaCastingBundle\Form\OffreType;


class OffreController extends Controller
{
    public function indexAction()
    {
        $manager = $this->getDoctrine()->getManager();
        
        $liste_offres = $manager
                            ->getRepository('MCMegaCastingBundle:Offre')
                            ->findBy(array(),
                                    array('datepublication' => 'desc'));
        
        $liste_metiers = $manager 
                            ->getRepository('MCMegaCastingBundle:Metier')
                            ->findAll();
        
        
        return $this->render('MCMegaCastingBundle:Offre:index.html.twig', 
                array(  'liste_offres' => $liste_offres,
                        'liste_metiers' => $liste_metiers));       
        
    }
    
    public function viewAction($id_offre)
    {
        $manager = $this->getDoctrine() 
                           ->getManager();
        
        $offre = $manager
                ->getRepository('MCMegaCastingBundle:Offre')
                ->find($id_offre);
        
        return $this->render('MCMegaCastingBundle:Offre:view.html.twig', 
                array('offre' => $offre));
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
        
        $liste_metiers = $manager 
                            ->getRepository('MCMegaCastingBundle:Metier')
                            ->findAll();
        
        $offres = $this->getDoctrine() 
                            ->getManager() 
                            ->getRepository('MCMegaCastingBundle:Offre')
                            ->findBy(array('domaine' => $domaine->getId())); 
        
        return $this->render('MCMegaCastingBundle:Offre:index.html.twig', 
                array(  'liste_offres' => $offres,
                        'liste_metiers' => $liste_metiers,
                        'libelle_domaine' => $libelle_domaine));
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
            if ($metier == null) 
            {
                $response = new RedirectResponse($this->container->get('router')->generate('mc_mega_casting_Offre_Domaine', 
                    array('libelle_domaine' => $libelle_domaine)));
                return $response;
            }            
        }
        
        $offres = $manager 
                            ->getRepository('MCMegaCastingBundle:Offre')
                            ->findBy(array('iddomaine' => $domaine->getId(),
                                            'idmetier' => $metier->getId()));
        
        $liste_metiers = $manager 
                            ->getRepository('MCMegaCastingBundle:Metier')
                            ->findAll();
        
        return $this->render('MCMegaCastingBundle:Offre:index.html.twig', 
                array(  'liste_offres' => $offres,
                        'liste_metiers' => $liste_metiers));
    }
    
    public function addAction(Request $request)
    {
        $offre = new Offre();
        
        // On recupere un annonceur via la variable de SESSION
        
        $manager = $this->getDoctrine() 
                        ->getManager();
        
        $annonceur = $manager->getRepository('MCMegaCastingBundle:Annonceur')
                             ->find(6);
        

        // On definit une date de publication 
        $offre->setDatepublication(new \DateTime('now'));

        // On l'insere dans l'offre que l'annonceur souhaite creer
        $offre->setAnnonceur($annonceur);
        
        // On genere le formulaire depuis le formulaire type d'une offre
        $form = $this->createForm(new OffreType(), $offre);
        
        // On fait le lien Requête <-> Formulaire
        // À partir de maintenant, la variable $offre contient les valeurs entrées dans le formulaire par l'annonceur
        $form->handleRequest($request);
        // On Verifie ensuite si l'ensemble des informations sont valides
        if ($form->isValid()){
            
            
            var_dump($offre);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($offre);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Offre bien enregistrée.');

            return $this->redirect($this->generateUrl('mc_mega_casting_homepage'));
        }
        return $this->render('MCMegaCastingBundle:Offre:add.html.twig',array(
            'form' => $form->createView(),
        ));
    }
    
    
    // Function qui va envoyer un tableau de metiers sous forme de Json au fichier Ajax
    public function metiersAction(Request $request, $id_domaine){
        
        // On securise l'appel de la fonction en precisant que seul Ajax peut appeler cette fonction
//        if($request->isXmlHttpRequest()){
            $manager = $this->getDoctrine() 
                                ->getManager(); 
            
            // On recupere l'ensemble des métiers rattachés à un domaine
            $liste_metiers = $manager     
                              ->getRepository('MCMegaCastingBundle:Metier')
                              ->findBy(array('domaine' => $id_domaine)); 
                  
            
            // Si la liste est non vide
            if($liste_metiers){
               $metiers = array();
               // On stocke les differents metiers à l'interieur d'un tableau
               foreach ($liste_metiers as $metier){
                   $metiers[] = $metier->getLibelle();
               }
            }else{
                $metier = null;
            }
            
           
            // On génere une reponse en Json pour pouvoir la réutiliser en Ajax
            $response = new JsonResponse();
            return $response->setData(array('metiers' => $metiers));
//        }else{
//            return new \Symfony\Component\Security\Acl\Exception\Exception("Erreur");
//        }
    }
    
}
