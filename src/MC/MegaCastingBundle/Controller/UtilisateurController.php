<?php

namespace MC\MegaCastingBundle\Controller;

use MC\MegaCastingBundle\Entity\Artiste;
use MC\MegaCastingBundle\Form\ArtisteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UtilisateurController extends Controller
{
    public function indexAction()
    {
        
    }
    
    public function addAction($type_user, Request $request)
    {
        $user = new Artiste();
        
        $form = $this->get('form.factory')->create(new ArtisteType(), $user);        
        
        // Lien requete - formulaire
        $form->handleRequest($request);
        
        // On vérifie que les valeurs entrées sont correctes (notament type POST)
        if ($form->isValid()) 
        {
            // Action
        }
        
        // On passe createView() du formulaire pour que la vue l'affiche
        return $this->render('MCMegaCastingBundle:Utilisateur:add.html.twig',
                array(  'form' => $form->createView(),
                        'type_user' => $type_user,
                    ));
    }
}
