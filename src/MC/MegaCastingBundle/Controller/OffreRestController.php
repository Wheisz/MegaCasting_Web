<?php 

namespace MC\MegaCastingBundle\Controller;

use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class OffreRestController extends Controller
{
    // Methodes pour l'API REST 
    
    public function getOffresAction()
    {
        $manager = $this->getDoctrine() 
                        ->getManager(); 
        $offres = $manager->getRepository('MCMegaCastingBundle:Offre')
                             ->findAll();  
        
        return array(
            'offres' => $offres,
         );
    }

    public function getPonyAction($annonceur)
    {
    }
}
