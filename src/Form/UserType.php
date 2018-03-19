<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('$email', EmailType::class)
            ->add('usename', TextType::class)
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('sex', ChoiceType::class, array(
                'choice' => array(
                    'Autre' => 'autre',
                    'Femme' => 'femme',
                    'Homme' => 'homme'
                )
            ))
            ->add('phoneNumber', TelType::class)
            ->add('adresse', TextType::class)
            ->add('codePostal', NumberType::class)
            ->add('ville', TextType::class)
            ->add('pays', CountryType::class)
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options' => array('label' => 'Mot de pass'),
                'second_options' => array('label' => 'confirmer mot de pass')
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }
}
