<?php

namespace MC\MegaCastingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArtisteController extends Controller
{
    public function indexAction()
    {
        return $this->render('MCMegaCastingBundle:Artiste:index.html.twig');
    }
}
