<?php

namespace MC\MegaCastingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

class OffreType extends AbstractType
{
    private $em;
    
    public function __construct($em) {
        $this->em = $em;
    }
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('intitule','text')
            ->add('reference','text')
            ->add('datepublication','date')
            ->add('dureediffusion')
            ->add('datedebutcontrat','date')
            ->add('nbposte')
            ->add('localisationlattitude','text')
            ->add('localisationlongitude','text')
            ->add('descriptionposte','text')
            ->add('descriptionprofil','text')
            ->add('telephone','text')
            ->add('email','text')
            ->add('domaine','entity',array(
                    'class'    => 'MCMegaCastingBundle:Domaine',
                    'property' => 'libelle',
                    'multiple' => false
            ))
            ->add('metier','entity',array(
                            'class' => 'MCMegaCastingBundle:Metier',
                            'property' => 'libelle'
            ))
            ->add('typecontrat','entity',array(
                    'class'    => 'MCMegaCastingBundle:TypeContrat',
                    'property' => 'libelle',
                    'multiple' => false
            ))
            ->add('Enregistrer','submit')
        ;
        
        $formModifier = function(FormInterface $form, $domaine){

            // On recupere l'ensemble des métiers rattachés à un domaine
            $liste_metiers = $this->em     
                              ->getRepository('MCMegaCastingBundle:Metier')
                              ->findBy(array('domaine' => $domaine)); 
                  
            
            // Si la liste est non vide
            if($liste_metiers){
               $metiers = array();
               // On stocke les differents metiers à l'interieur d'un tableau
               foreach ($liste_metiers as $metier){
                   $metiers[] = $metier;
               }
            }
           
            
            // On ajoute le champ metier de type choice
            $form->add('metier','entity',array(
                            'class' => 'MCMegaCastingBundle:Metier',
                            'property' => 'libelle',
                            'choices' => $metiers
            ));

        };  
        
               
//        $builder->addEventListener(
//            FormEvents::PRE_SET_DATA,
//            function(FormEvent $event) use ($formModifier) {
//                // ce sera votre entité, c-a-d Domaine
////                $domaine = $event->getForm()->getData();
////                
////                var_dump($domaine);
//                
//                
//                $domaine = $this->em
//                                ->getRepository('MCMegaCastingBundle:Domaine')
//                                ->find(1); 
//               
//
//                $formModifier($event->getForm(), $domaine);
//            }
//        );
        
        $builder->addEventListener(
                FormEvents::PRE_SET_DATA, 
                function(FormEvent $event) use ($formModifier){
                    $data = $event->getData();
                    
                    var_dump($data);
                    // on Envoie tout le formulaire (getParent)
                    $formModifier($event->getForm()->getParent(), $data);
        });
        
        // On va ecouter le champ Domaine lors du changement de domaine
        // On declenche le listener 
        
        $builder->get('domaine')->addEventListener(
                FormEvents::POST_SUBMIT, 
                function(FormEvent $event) use ($formModifier){
                    $domaine = $event->getForm()->getData();
                    
                    var_dump($domaine);
                    // on Envoie tout le formulaire (getParent)
                    $formModifier($event->getForm()->getParent(), $domaine);
        });
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MC\MegaCastingBundle\Entity\Offre'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mc_megacastingbundle_offre';
    }
}
