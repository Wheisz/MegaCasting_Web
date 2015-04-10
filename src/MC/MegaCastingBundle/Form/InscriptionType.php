<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MC\MegaCastingBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType;

class InscriptionType extends RegistrationFormType
{
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        parent::buildForm($builder, $options);
        
        $builder->add('captcha', 'genemu_captcha', array('mapped' => false,));
    }
    
    public function getName()
    {
        return 'eni_inscription';
    }
}
