<?php

namespace App\Form;

use App\Entity\ProduitIntern;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitInternType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fournisseur',TextType::class)
            ->add('prixAchat',MoneyType::class)
            ->add('tauxVente',NumberType::class)
            ->add('designation',TextType::class)
            /*->add('prixVentes', MoneyType::class)*/
            ->add('tva', NumberType::class)
            ->add('dateAjout', DateType::class)
            ->add('imageFemme', ImageType::class)
            ->add('imageHomme', ImageType::class)
            ->add('imageZoomItem', ImageType::class)
            ->add('imageZoomListe', ImageType::class)
            ->add('save',SubmitType::class)
            ->getForm()
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => ProduitIntern::class,
        ));
    }
}
