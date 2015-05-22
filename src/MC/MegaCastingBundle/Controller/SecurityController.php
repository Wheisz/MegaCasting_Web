<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MC\MegaCastingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\RedirectResponse;
use MC\MegaCastingBundle\Entity\Utilisateur;
use MC\MegaCastingBundle\Entity\Artiste;
use MC\MegaCastingBundle\Form\UtilisateurType;

class SecurityController extends Controller
{
    public function loginAction(Request $request)
    {
        $user = new Utilisateur();
        
        $form = $this->get('form.factory')->create(new UtilisateurType(), $user, 
                array('type' => 'login', 'action' => 'login_check'));        
        
        // Lien requete - formulaire
        $form->handleRequest($request);
        
        // Si le visiteur est déjà identifié, on le redirige vers l'accueil
        if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
          return $this->redirect($this->generateUrl('mc_mega_casting_homepage'));
        }

        $session = $request->getSession();

        // On vérifie s'il y a des erreurs d'une précédente soumission du formulaire
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
          $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
          $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
          $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
        
        $form->get('username')->setData($session->get(SecurityContext::LAST_USERNAME));

        return $this->render('MCMegaCastingBundle:Security:login.html.twig', array(
          // Valeur du précédent nom d'utilisateur entré par l'internaute
            'error'         => $error,
            'form' => $form->createView(),
        ));
    }
    
    public function registerAction(Request $request, $type_user)
    {
        $user = new Utilisateur();
        $form = $this->get('form.factory')->create(new UtilisateurType(), $user, 
                array('type' => 'register'));

        if ($form->handleRequest($request)->isValid()) 
        {
            $em = $this->getDoctrine()->getManager();
            
            if ($type_user == 'artiste') {
                $role = $em
                            ->getRepository('MCMegaCastingBundle:Role')
                            ->findOneByRole('ROLE_ARTISTE');
                
                $role->addUtilisateur($user);
                
                $artiste = new Artiste();
                $artiste->setUtilisateur($user);
                $em->persist($artiste);
            }
            else if ($type_user == 'annonceur') {
                $role = $em
                            ->getRepository('MCMegaCastingBundle:Role')
                            ->findOneByRole('ROLE_ANNONCEUR');
                
                $role->addUtilisateur($user);
            }
            
            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($user);
            $password = $encoder->encodePassword($user->getPassword(), $user->getSalt());
            $user->setPassword($password);
            
            $em->persist($role);
            $em->persist($user);
            $em->flush();

            if ($type_user == 'artiste') {
                return $this->redirect($this->generateUrl('mc_mega_casting_EspacePerso'));
            }
            else if ($type_user == 'annonceur') {
                return $this->redirect($this->generateUrl('mc_mega_casting_EspacePro'));
            }
            else {
                return $this->redirect($this->generateUrl('mc_mega_casting_homepage'));
            }            
        }

        return $this->render('MCMegaCastingBundle:Security:register.html.twig', array(
          'form' => $form->createView(), 'type_user' => $type_user
        ));
    }
    
    public function updateAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $user = $this->getUser();
        $original_password = $user->getPassword();
        $original_username = $user->getUsername();
        
        $form = $this->get('form.factory')->create(new UtilisateurType(), $user, 
                array('type' => 'update'));
        
        $errors = array();
        
        if ($form->handleRequest($request)->isValid()) 
        {
            // Si changement de pseudo
            if ($user->getUsername() != $original_username) {
                // Vérifier que pas déjà utilisé
                $user_temp = $em
                        ->getRepository('MCMegaCastingBundle:Utilisateur')
                        ->findOneByUsername($user->getUsername());
                
                if ($user_temp != null) {
                    $errors[] = 'Ce pseudo est déjà utilisé';
                }
            }
            
            // Si changement mot de passe
            if ($user->getPassword() != null) {
                // On l'encode
                $factory = $this->get('security.encoder_factory');
                $encoder = $factory->getEncoder($user);
                $password = $encoder->encodePassword($user->getPassword(), $user->getSalt());
                $user->setPassword($password);                
            }
            // Sinon
            else {
                // On remet l'ancien                
                $user->setPassword($original_password);
            }
            
            if (empty($errors)) {
                $em->persist($user);
                $em->flush();
                
                $response = new RedirectResponse($this->container->get('router')->generate('mc_mega_casting_EspacePerso'));
                return $response;
            }  
        }

        return $this->render('MCMegaCastingBundle:Security:update.html.twig', array(
          'form' => $form->createView(),
            'errors' => $errors
        ));
    }
}

