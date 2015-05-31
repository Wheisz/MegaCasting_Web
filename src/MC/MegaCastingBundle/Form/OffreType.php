<?php

namespace MC\MegaCastingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

use MC\MegaCastingBundle\Entity\Domaine;

class OffreType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('intitule','text')
            ->add('reference','text')
            ->add('dureediffusion')
            ->add('datedebutcontrat','date', array(
                'empty_value' => array(
                    'day' => 'Jour',
                    'month' => 'Mois',
                    'year' => 'Année'
                )
            ))
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
                    'multiple' => false,
            ))
            ->add('typecontrat','entity',array(
                    'class'    => 'MCMegaCastingBundle:Typecontrat',
                    'property' => 'libelle',
                    'multiple' => false
            ))
            ->add('Enregistrer','submit')
        ;
        
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
                    $data = $event->getData();
                    
  
                    // on Envoie tout le formulaire (getParent)
                    $formModifier($event->getForm(), $data->getDomaine());
                    
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
