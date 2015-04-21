<?php

namespace MC\MegaCastingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

class EspaceProController extends Controller
{
    public function indexAction()
    {
        return $this->render('MCMegaCastingBundle:EspacePro:index.html.twig');
    }
    
    public function registerAction()
    {
        $response = new RedirectResponse($this->container->get('router')->generate('mc_mega_casting_Utilisateur_Register', array('type_user' => 'Annonceur')));
            return $response;
    }
}
