<?php

namespace MC\MegaCastingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArtisteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('datenaissance', 'date')
                ->add('sexe', 'entity', array(
                        'class'    => 'MCMegaCastingBundle:Sexe',
                        'property' => 'libelle',
                        'multiple' => true))          
                ->add('caracteristiquephysique', new CaracteristiquephysiqueType())                
                ->add('metier', 'entity', array(
                        'class'    => 'MCMegaCastingBundle:Metier',
                        'property' => 'libelle',
                        'multiple' => true))
                ->add('save', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MC\MegaCastingBundle\Entity\Artiste'
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
