<?php

namespace MC\MegaCastingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MC\MegaCastingBundle\Entity\Artiste;
use MC\MegaCastingBundle\Entity\Photo;
use MC\MegaCastingBundle\Form\ArtisteType;
use MC\MegaCastingBundle\Form\PhotoType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\RedirectResponse;

class EspacePersoController extends Controller
{
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        
        $manager = $this->getDoctrine()->getManager();
        
//        $user = $manager
//                    ->getRepository('MCMegaCastingBundle:Utilisateur')
//                    ->findByUsername($session->get(SecurityContext::LAST_USERNAME));
        $user = $manager
                ->getRepository('MCMegaCastingBundle:Utilisateur')
                ->findOneById(1);
        
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
        if ($type_info == 'photo-profil') {
            $photo = new Photo();
            
            $form = $this->get('form.factory')->create(new PhotoType(), $photo);
        }
        else {
            $artiste = new Artiste();
        
            $form = $this->get('form.factory')->create(new ArtisteType(), $artiste, 
                    array('type_info' => $type_info)); 
        }
        

        if ($form->handleRequest($request)->isValid()) 
        {
            if ($type_info == 'photo-profil') {
                
                $manager = $this->getDoctrine()->getManager();
                
                $user = $manager
                    ->getRepository('MCMegaCastingBundle:Utilisateur')
                    ->findOneById(1);
        
                $artiste = $manager
                    ->getRepository('MCMegaCastingBundle:Artiste')
                    ->findOneByUtilisateur($user);
                
                foreach ($artiste->getPhotos() as $p) {
                    if ($p->getIsprofile() == 1) {
                        $p->setIsprofile(0);
                    }
                }
                
                $photo->setArtiste($artiste);
                $photo->setIsprofile(1);
                
                $photo->upload(); 
                $photo_exist = false;
                foreach ($artiste->getPhotos() as $p) {
                    if ($p->getUrl() == $photo->getUrl()) {
                        $photo = $p;
                        $photo->setIsprofile(1);
                    }
                }
                
                $manager->persist($photo);
                $manager->flush();
            }
            
            $response = new RedirectResponse($this->container->get('router')->generate('mc_mega_casting_EspacePerso'));
            return $response;
        }

        return $this->render('MCMegaCastingBundle:EspacePerso:update.html.twig', array(
          'form' => $form->createView(), 
        ));
    }
}
