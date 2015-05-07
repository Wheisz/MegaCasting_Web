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
                ->add('metier', 'entity', array(
                        'class'    => 'MCMegaCastingBundle:Metier',
                        'property' => 'libelle',
                        'multiple' => true,
                    'required' => false,
                    ))
                ;
        }
        else if ($options['type_info'] == 'caracPhysique') {
            $builder->add('caracteristiquephysique', new CaracteristiquephysiqueType());
        }
        
        $builder->add('Sauvegarder', 'submit');
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
