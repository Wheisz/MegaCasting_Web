<?php

namespace MC\MegaCastingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EspacePersoController extends Controller
{
    public function indexAction()
    {
        return $this->render('MCMegaCastingBundle:EspacePerso:index.html.twig');
    }
    
    public function loginAction()
    {
        $manager = $this->getDoctrine()->getManager();
        
             
        
    }
    
    public function logoutAction()
    {
        
    }
}
