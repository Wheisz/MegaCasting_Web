<?php

namespace MC\MegaCastingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AdresseType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero', 'text', array(
                'required' => false
                ))
            ->add('rue', 'text', array(
                'required' => false
                ))
            ->add('codepostal', 'text', array(
                'required' => false
                ))
            ->add('ville', 'text', array(
                'required' => false
                ))
            ->add('Sauvegarder', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MC\MegaCastingBundle\Entity\Adresse'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mc_megacastingbundle_adresse';
    }
}
