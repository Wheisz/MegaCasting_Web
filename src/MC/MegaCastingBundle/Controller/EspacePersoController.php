<?php

namespace MC\MegaCastingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

class EspacePersoController extends Controller
{
    public function indexAction()
    {
        return $this->render('MCMegaCastingBundle:EspacePerso:index.html.twig');
    }
    
    public function loginAction()
    {
        
    }
    
    public function logoutAction()
    {
        
    }
    
    public function registerAction()
    {
        $response = new RedirectResponse($this->container->get('router')->generate('mc_mega_casting_Utilisateur_Register', array('type_user' => 'Artiste')));
            return $response;
    }
}
