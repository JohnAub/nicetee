<?php

namespace App\Form;

use App\Entity\ChangePassword;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('oldPassword', PasswordType::class, array('label' => 'Mot de pass actuel'))
            ->add('newPassword',  RepeatedType::class, array(
            'type' => PasswordType::class,
            'invalid_message' => 'Les mots de passes ne sont pas identique.',
            'required' => true,
            'first_options'  => array('label' => 'Nouveau mot de pass'),
            'second_options' => array('label' => 'confirmer nouveau mot de pass'),
            ))
            ->add('save',SubmitType::class)
        ;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => ChangePassword::class,
            )
        );
    }

    public function getName()
    {
        return 'change_passwd';
    }
}
