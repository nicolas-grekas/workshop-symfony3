<?php

namespace Smoovio\Bundle\PortalBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text')
            ->add('email', 'email')
            ->add('password', 'repeated', array(
                'first_name'  => 'password',
                'second_name' => 'confirm',
                'type'        => 'password',
            ))
            ->add('terms', 'checkbox', array(
                'property_path' => 'termsAccepted',
            ))
            ->add('Sign Up!', 'submit')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Smoovio\Bundle\CoreBundle\User\Registration\Registration',
            'validation_groups' => array('Default', 'Signup'),
        ));
    }

    public function getName()
    {
        return 'smoovio_core_registration_form';
    }
} 
