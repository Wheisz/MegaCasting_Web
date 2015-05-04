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
        if ($options['type'] == 'register') {
            $builder
                    ->add('username', 'text')
                    ->add('password', 'repeated', array(
                            'type' => 'password',
                            'invalid_message' => 'Les mots de passe doivent correspondre',
                            'options' => array('required' => true),
                            'first_options'  => array('label' => 'Mot de passe'),
                            'second_options' => array('label' => 'Mot de passe (validation)'),))
                    ->add('email', 'email')
                    ->add('Inscription', 'submit');
        }
        else if ($options['type'] == 'login')
        {
           $builder
                   ->add('username', 'text')
                   ->add('password', 'password')
                   ->add('Connexion', 'submit');
        }        
        else if ($options['type'] == 'update') {
            $builder
                    ->add('email', 'email')
                    ->add('password', 'repeated', array(
                            'type' => 'password',
                            'invalid_message' => 'Les mots de passe doivent correspondre',
                            'options' => array('required' => true),
                            'first_options'  => array('label' => 'Mot de passe'),
                            'second_options' => array('label' => 'Mot de passe (validation)'),))
                    ->add('Sauvegarder', 'submit')
                    ;            
        }
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MC\MegaCastingBundle\Entity\Utilisateur',
            'type' => '',
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
