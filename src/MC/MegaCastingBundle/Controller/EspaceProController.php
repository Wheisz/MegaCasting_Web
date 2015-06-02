<?php

namespace MC\MegaCastingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use MC\MegaCastingBundle\Form\AnnonceurType;
use MC\MegaCastingBundle\Form\AdresseType;
use MC\MegaCastingBundle\Entity\Adresse;

class EspaceProController extends Controller
{
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        
        $manager = $this->getDoctrine()->getManager();
        
        $user = $this->getUser();
        
        $annonceur = $manager
                ->getRepository('MCMegaCastingBundle:Annonceur')
                ->findOneByUtilisateur($user);
        
        return $this->render('MCMegaCastingBundle:EspacePro:index.html.twig',
                array(  'annonceur' => $annonceur));
    }
    
    public function registerAction()
    {
        $response = new RedirectResponse($this->container->get('router')->generate('mc_mega_casting_Utilisateur_Register', array('type_user' => 'Annonceur')));
            return $response;
    }
    
    public function updateAction(Request $request, $type_info)
    {
        $manager = $this->getDoctrine()->getManager();        
        $user = $this->getUser();
        
        $em_user = $manager
                    ->getRepository('MCMegaCastingBundle:Utilisateur')
                    ->findOneByUsername($user->getUsername());
        
        $annonceur = $manager
                    ->getRepository('MCMegaCastingBundle:Annonceur')
                    ->findOneByUtilisateur($em_user);
        
        $origin_siret = $annonceur->getNumerosiret();
        $origin_raisonsociale = $annonceur->getRaisonsociale();
        
        if ($type_info == 'general') {
            $form = $this->get('form.factory')->create(new AnnonceurType(), $annonceur);
        }
        // Si update de l'adresse
        else if ($type_info == 'adresse') {
            // Si l'annonceur a déjà une adresse
            if ($annonceur->getAdresse() != null) {
                // On la récupère
                $adresse = $annonceur->getAdresse();
            }
            else {
                // Sinon on crée une nouvelle
                $adresse = new Adresse();
            }
            $form = $this->get('form.factory')->create(new AdresseType(), $adresse);
        }  
        
        $errors = array();

        if ($form->handleRequest($request)->isValid()) 
        {            
            if ($type_info == 'adresse') {
                
                // Si nouvelle adresse
                if ($adresse->getId() == null) {
                    // on la lie à la societe
                    $annonceur->setAdresse($adresse);
                }
                
                if (empty($errors)) {
                    $manager->persist($adresse);
                    $manager->persist($annonceur);
                }                
            }
            
            if ($type_info == 'general') {
                
                // Si changement SIRET
                if ($origin_siret != $annonceur->getNumerosiret()) {
                    // Si SIRET existe déjà
                    $temp_annonceur = $manager
                        ->getRepository('MCMegaCastingBundle:Annonceur')
                        ->findOneByNumerosiret($annonceur->getNumerosiret());
                    if ($temp_annonceur != null) {
                        $errors[] = 'Ce N° SIRET est déjà utilisé';
                        $temp_annonceur = null;
                    }
                }                
                
                // Si changement raison sociale
                if ($origin_raisonsociale != $annonceur->getRaisonsociale()) {
                    // Si raison sociale existe déjà
                    $temp_annonceur = $manager
                        ->getRepository('MCMegaCastingBundle:Annonceur')
                        ->findOneByRaisonsociale($annonceur->getRaisonsociale());
                    if ($temp_annonceur != null) {
                        $errors[] = 'Cette raison sociale est déjà utilisée';
                        $temp_annonceur = null;
                    }
                }                
                
                // Si tel saisi et pas un entier
                if ($annonceur->getTelephone() && !is_numeric($annonceur->getTelephone())) {
                    $errors[] = 'Le numéro de téléphone doit être un nombre entier';
                }
                
                if (empty($errors)) {
                    $manager->persist($annonceur);
                }
            }
            
            if (empty($errors)) {    
                // Sauvegarde des changements en bdd
                $manager->flush();
                
                $response = new RedirectResponse($this->container->get('router')->generate('mc_mega_casting_EspacePro'));
                return $response;                
            } 
        }

        return $this->render('MCMegaCastingBundle:EspacePro:update.html.twig', array(
          'form' => $form->createView(),
            'type_info' => $type_info,
            'errors' => $errors,
        ));
    }
}
