<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Entity\ProduitIntern;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class ProduitInternController extends Controller
{
    /**
     * @Route("/addteeintern")
     */
    public function addAction(Request $request)
    {
        $tee =  new ProduitIntern();
        $form = $this->get('form.factory')->createBuilder(FormType::class, $tee)
            ->add('fournisseur',TextType::class)
            ->add('prixAchat',MoneyType::class)
            ->add('tauxVente',NumberType::class)
            ->add('designation',TextType::class)
            ->add('prixVentes', MoneyType::class)
            ->add('tva', NumberType::class)
            ->add('dateAjout', DateType::class)
            ->add('imageHomme', TextType::class)
            ->add('imageFemme', TextType::class)
            ->add('imageZoomListe', TextType::class)
            ->add('imageZoomItem', TextType::class)
            ->add('save',SubmitType::class)
            ->getForm()
        ;
        if ($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($tee);
                $em->flush();
            }
        }

        return $this->render('addTeeIntern.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
