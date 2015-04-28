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
use MC\MegaCastingBundle\Entity\Utilisateur;
use MC\MegaCastingBundle\Form\UtilisateurType;

class SecurityController extends Controller
{
    public function loginAction(Request $request)
    {
        $user = new Utilisateur();
        
        $form = $this->get('form.factory')->create(new UtilisateurType(), $user, 
                array('register' => '1', 'action' => 'login_check'));        
        
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
                array('register' => '0'));

        if ($form->handleRequest($request)->isValid()) 
        {
            $em = $this->getDoctrine()->getManager();
            
            if ($type_user == 'artiste') {
                $role = $em
                            ->getRepository('MCMegaCastingBundle:Role')
                            ->findOneByRole('ROLE_ARTISTE');
                
                $role->addUtilisateur($user);
            }
            else if ($type_user == 'annonceur') {
                $role = $em
                            ->getRepository('MCMegaCastingBundle:Role')
                            ->findOneByRole('ROLE_ANNONCEUR');
                
                $role->addUtilisateur($user);
            }
            
            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($user);
            $password = $encoder->encodePassword('ryanpass', $user->getSalt());
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
}

