<?php

namespace MC\MegaCastingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

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
                ->add('domaine','entity',array(
                    'class'    => 'MCMegaCastingBundle:Domaine',
                    'property' => 'libelle',
                    'multiple' => false,
                    'mapped' => false,
                    ))
                ;
        }
        else if ($options['type_info'] == 'caracPhysique') {
            $builder->add('caracteristiquephysique', new CaracteristiquephysiqueType());
        }
        
        $builder->add('Sauvegarder', 'submit');
        
        $formModifier = function(FormInterface $form, Domaine $domaine = null){
            
            // On recupere l'ensemble des métiers rattachés à un domaine
            $metiers = null === $domaine ? array() : $domaine->getMetiers();
                  
            // On ajoute le champ metier de type entity
            $form->add('metier','entity',array(
                            'class' => 'MCMegaCastingBundle:Metier',
                            'property' => 'libelle',
                            'choices' => $metiers
            ));

        };  

        $builder->addEventListener(
                FormEvents::PRE_SET_DATA, 
                function(FormEvent $event) use ($formModifier){
                    $data = $event->getForm()->get('domaine')->getData();                    
  
                    // on Envoie tout le formulaire (getParent)
                    $formModifier($event->getForm(), $data);
                    
        });
        
        // On va ecouter le champ Domaine lors du changement de domaine
        // On declenche le listener 
        
        $builder->get('domaine')->addEventListener(
                FormEvents::POST_SUBMIT, 
                function(FormEvent $event) use ($formModifier){
                    // On recupere la valeur du champ Domaine
                    $domaine = $event->getForm()->getData();
                    
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
