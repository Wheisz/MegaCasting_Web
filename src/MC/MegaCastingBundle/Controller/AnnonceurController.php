<?php

namespace MC\MegaCastingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AnnonceurController extends Controller
{
    public function indexAction()
    {
        return $this->render('MCMegaCastingBundle:Annonceur:index.html.twig');
    }
}
