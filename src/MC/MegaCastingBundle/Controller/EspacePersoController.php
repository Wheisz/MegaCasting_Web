<?php

namespace MC\MegaCastingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MC\MegaCastingBundle\Entity\Photo;
use MC\MegaCastingBundle\Form\ArtisteType;
use MC\MegaCastingBundle\Form\PhotoType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class EspacePersoController extends Controller
{
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        
        $manager = $this->getDoctrine()->getManager();
        
        $user = $this->getUser();
        
        $artiste = $manager
                ->getRepository('MCMegaCastingBundle:Artiste')
                ->findOneByUtilisateur($user);
        
        return $this->render('MCMegaCastingBundle:EspacePerso:index.html.twig',
                array(  'artiste' => $artiste));
    }
    
    public function registerAction()
    {
        $response = new RedirectResponse($this->container->get('router')->generate('mc_mega_casting_Utilisateur_Register', array('type_user' => 'Artiste')));
            return $response;
    }
    
    public function updateAction(Request $request, $type_info)
    {
        $manager = $this->getDoctrine()->getManager();
        
        $user = $this->getUser();
        
        $em_user = $manager
                    ->getRepository('MCMegaCastingBundle:Utilisateur')
                    ->findOneByUsername($user->getUsername());
        
        $artiste = $manager
                    ->getRepository('MCMegaCastingBundle:Artiste')
                    ->findOneByUtilisateur($em_user);
        
        if ($type_info == 'photo-profil') {
            $photo = new Photo();
            
            $form = $this->get('form.factory')->create(new PhotoType(), $photo);
        }
        else {        
            $form = $this->get('form.factory')->create(new ArtisteType(), $artiste, 
                    array('type_info' => $type_info)); 
        }  
        
        $errors = array();

        if ($form->handleRequest($request)->isValid()) 
        {            
            if ($type_info == 'photo-profil') {
                
                foreach ($artiste->getPhotos() as $p) {
                    // si la photo est celle de profile on l'enlève
                    if ($p->getIsprofile() == 1) {
                        $p->setIsprofile(0);
                    }
                }
                
                $photo->setArtiste($artiste); // On lui met l'artiste
                $photo->setIsprofile(1); // On la met en photo de profil
                
                $photo->upload();
                
                foreach ($artiste->getPhotos() as $p) {
                    // si la photo existait déjà on la met en photoProfile
                    if ($p->getUrl() == $photo->getUrl()) {
                        $photo = $p;
                        $photo->setIsprofile(1);
                    }
                }
                
                if (empty($errors)) {
                    $manager->persist($photo);
                }                
            }
            
            if ($type_info == 'caracPhysique') {
                // Si saisi et pas un entier
                if ($artiste->getCaracteristiquephysique()->getPoids() && !is_int($artiste->getCaracteristiquephysique()->getPoids())) {
                    $errors[] = 'Le poids doit être un nombre entier';
                }
                if ($artiste->getCaracteristiquephysique()->getTaille() && !is_int($artiste->getCaracteristiquephysique()->getTaille())) {
                    $errors[] = 'La taille doit être un nombre entier';
                }
                
                if (empty($errors)) {
                    $manager->persist($artiste);
                }                
            }
            
            if ($type_info == 'general') {
                if (empty($errors)) {
                    $manager->persist($artiste);
                }
            }
            
            if (empty($errors)) {                    
                $manager->flush();
                
                $response = new RedirectResponse($this->container->get('router')->generate('mc_mega_casting_EspacePerso'));
                return $response;                
            } 
        }
        
        if ($type_info == 'general') {
            return $this->render('MCMegaCastingBundle:Artiste:update.html.twig', array(
                'form' => $form->createView(),
                'type_info' => $type_info,
                'errors' => $errors,
            ));
        }
        return $this->render('MCMegaCastingBundle:EspacePerso:update.html.twig', array(
          'form' => $form->createView(),
            'type_info' => $type_info,
            'errors' => $errors,
        ));
    }
}
