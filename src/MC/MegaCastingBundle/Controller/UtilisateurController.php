<?php

namespace MC\MegaCastingBundle\Controller;

use MC\MegaCastingBundle\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UtilisateurController extends Controller
{
    public function indexAction()
    {
        
    }
    
    public function addAction($type_user, Request $request)
    {
        $user = new Utilisateur();
        
        // FormBuilder
        $formBuilder = $this->get('form.factory')->createBuilder('form', $user);
        
        // Ajout des champs
        $formBuilder
                ->add('pseudo',     'text')
                ->add('MotDePasse', 'password')
                ->add('email',      'email')
                ->add('save',       'submit')
                ;
        
        // Si l'utilisateur est un Annonceur
        if($type_user == 'Annonceur')
        {
            
        }
        // Sinon si c'est un Artiste
        else if ($type_user == 'Artiste')
        {
            
        }
        
        // Génération du formulaire
        $form = $formBuilder->getForm();
        
        
        // Lien requete - formulaire
        $form->handleRequest($request);
        
        // On vérifie que les valeurs entrées sont correctes
        
        
        // On passe createView() du formulaire pour que la vue l'affiche
        return $this->render('MCMegaCastingBundle:Utilisateur:add.html.twig',
                array(  'form' => $form->createView(),
                        'type_user' => $type_user,
                    ));
    }
}
