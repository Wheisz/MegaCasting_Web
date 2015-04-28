<?php

namespace MC\MegaCastingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UtilisateurType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text')
        ;
        
        if ($options['register'] != '1') {
            $builder
                    ->add('password', 'repeated', array(
                            'type' => 'password',
                            'invalid_message' => 'Les mots de passe doivent correspondre',
                            'options' => array('required' => true),
                            'first_options'  => array('label' => 'Mot de passe'),
                            'second_options' => array('label' => 'Mot de passe (validation)'),))
                    ->add('email', 'email')
                    ->add('Inscription', 'submit');
        }
        else
        {
           $builder
                   ->add('password', 'password')
                   ->add('Connexion', 'submit');
        }       
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MC\MegaCastingBundle\Entity\Utilisateur',
            'register' => '0',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mc_megacastingbundle_utilisateur';
    }
}
