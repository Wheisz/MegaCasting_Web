<?php

namespace MC\MegaCastingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MC\MegaCastingBundle\Entity\Artiste;
use MC\MegaCastingBundle\Form\ArtisteType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\RedirectResponse;

class EspacePersoController extends Controller
{
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        
        $manager = $this->getDoctrine()->getManager();
        
        $user = $manager
                    ->getRepository('MCMegaCastingBundle:Utilisateur')
                    ->findByUsername($session->get(SecurityContext::LAST_USERNAME));
        
        return $this->render('MCMegaCastingBundle:EspacePerso:index.html.twig',
                array(  'user' => $user));
    }
    
    public function registerAction()
    {
        $response = new RedirectResponse($this->container->get('router')->generate('mc_mega_casting_Utilisateur_Register', array('type_user' => 'Artiste')));
            return $response;
    }
    
    public function updateAction(Request $request)
    {
        $artiste = new Artiste();
        $form = $this->get('form.factory')->create(new ArtisteType(), $artiste);

        if ($form->handleRequest($request)->isValid()) 
        {
                        
        }

        return $this->render('MCMegaCastingBundle:EspacePerso:update.html.twig', array(
          'form' => $form->createView(), 
        ));
    }
}
