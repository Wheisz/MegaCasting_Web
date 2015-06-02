<?php

namespace MC\MegaCastingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use MC\MegaCastingBundle\Entity\Domaine;

class ArtisteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {   
        if ($options['type_info'] == 'photo-profil') {
            
        }
        else if ($options['type_info'] == 'general') {
            $metiers;
            
            $builder
                ->add('datenaissance', 'date', array(
                    'empty_value' => array('year' => 'Année', 'month' => 'Mois', 'day' => 'Jour'),
                    'years' => range(date('Y') - 100, date('Y')),
                    'required' => true,
                    ))
                ->add('sexe', 'entity', array(
                    'class'    => 'MCMegaCastingBundle:Sexe',
                    'property' => 'libelle',
                    'multiple' => false,
                    'required' => false,
                    ))
                ->add('metier','entity',array(
                    'class'    => 'MCMegaCastingBundle:Metier',
                    'property' => 'nomComplet',
                    'multiple' => true,
                    'expanded' => true,
                    'mapped' => true,
                    ))
                ;
        }
        else if ($options['type_info'] == 'caracPhysique') {
            $builder->add('caracteristiquephysique', new CaracteristiquephysiqueType());
        }
        
        $builder->add('Sauvegarder', 'submit');
        
//        // Fonction pour charger la liste des métiers de l'artiste
//        $formModifier_mesMetiers = function(FormInterface $form, $artisteMetiers){           
//            
//            // On 
//                  
//            // On ajoute le champ metier de type entity
//            $form->add('metier','entity',array(
//                'class' => 'MCMegaCastingBundle:Metier',
//                'property' => 'libelle',
//                'multiple' => true,
//                'choices' => $artisteMetiers,
//            ));
//
//        };
//        
//        // Fonction pour charger une liste de métiers
//        $formModifier_listMetier = function(FormInterface $form, Domaine $domaine = null){
//            
//            // On recupere l'ensemble des métiers rattachés à un domaine
//            $metiers = null === $domaine ? array() : $domaine->getMetiers();
//                  
//            // On ajoute le champ metier de type entity
//            $form->add('listMetier','entity',array(
//                'class' => 'MCMegaCastingBundle:Metier',
//                'property' => 'libelle',
//                'choices' => $metiers,
//                'mapped' => false,
//                'placeholder' => 'Choisir un métier'
//            ));            
//        };  
//        
//        
//
//        $builder->addEventListener(
//                FormEvents::PRE_SET_DATA, 
//                function(FormEvent $event) use ($formModifier_listMetier, $formModifier_mesMetiers){
//                    $data = $event->getForm()->get('domaine')->getData(); 
//                    // on Envoie tout le formulaire (getParent)
//                    $formModifier_listMetier($event->getForm(), $data);
//                    
//                    $artisteMetiers = $event->getData()->getMetier();
//                    $formModifier_mesMetiers($event->getForm(), $artisteMetiers);
//                    
//        });
//        
//        // On va ecouter le champ Domaine lors du changement de domaine
//        // On declenche le listener 
//        
//        $builder->get('domaine')->addEventListener(
//                FormEvents::POST_SUBMIT, 
//                function(FormEvent $event) use ($formModifier_listMetier){
//                    // On recupere la valeur du champ Domaine
//                    $domaine = $event->getForm()->getData();
//                    
//                    // on Envoie tout le formulaire (getParent)
//                    $formModifier_listMetier($event->getForm()->getParent(), $domaine);                    
//                    
//        });  
//        
//        if (array_key_exists('listMetier', $builder->all())) {
//            $builder->get('listMetier')->addEventListener(
//                FormEvents::POST_SUBMIT, 
//                function(FormEvent $event) use ($formModifier_mesMetiers){
//                    // On recupere la valeur du champ Domaine
//                    $metier = $event->getForm()->getData();
//                    
//                    $event->getData()->addMetier($metier);
//                    $artisteMetiers = $event->getData()->getMetier();
//                    // on Envoie tout le formulaire (getParent)
//                    $formModifier_mesMetiers($event->getForm()->getParent(), $artisteMetiers);
//            });
//        }
        

    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MC\MegaCastingBundle\Entity\Artiste',
            'type_info' => '0',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mc_megacastingbundle_artiste';
    }
}
