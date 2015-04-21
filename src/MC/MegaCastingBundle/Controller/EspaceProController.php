<?php

namespace MC\MegaCastingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EspaceProController extends Controller
{
    public function indexAction()
    {
        return $this->render('MCMegaCastingBundle:EspacePro:index.html.twig');
    }
}
