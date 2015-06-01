<?php

namespace MC\MegaCastingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AnnonceurType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numerosiret', 'text', array(
                'required' => false
            ))
            ->add('raisonsociale', 'text', array(
                'required' => false
                ))
            ->add('email', 'email', array(
                'required' => false
                ))
            ->add('telephone', 'text', array(
                'required' => false,
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
            'data_class' => 'MC\MegaCastingBundle\Entity\Annonceur'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mc_megacastingbundle_annonceur';
    }
}
