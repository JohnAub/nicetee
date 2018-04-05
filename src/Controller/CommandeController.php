<?php

namespace App\Controller;

use App\Entity\DeliveryAdressUser;
use App\Entity\Panier;
use App\Entity\ProduitIntern;
use App\Entity\User;
use App\Form\DeliveryAdressUserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CommandeController extends Controller
{
    /**
     * @Route("/panier/livraison", name="livraison")
     */
    public function ajouter(Request $request)
    {
        $session = $request->getSession();
        if (!($session->has('panier')))
        {
            return $this->redirectToRoute('panier');
        }else{
            $arrayPanier = $session->get('panier');
            $panier = new Panier();
            $panier->setPanier($arrayPanier);
        }
        $sortPanier = $panier->sortPanier();
        if (count($sortPanier) == 0)
            return $this->redirectToRoute('panier');

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $deliveryAdressUser = new DeliveryAdressUser();
        $form = $this->createForm(DeliveryAdressUserType::class, $deliveryAdressUser);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $user->addDeliveryAdressUser($deliveryAdressUser);
            $em = $this->getDoctrine()->getManager();
            $em->persist($deliveryAdressUser);
            $em->flush();
            return $this->redirectToRoute('payement', array(
                'idAdresse' => $deliveryAdressUser->getId()
            ));
        }
        return $this->render('livraison.html.twig', array(
            'user' => $user,
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/panier/payement/{idAdresse}", name="payement")
     */
    public function payement(Request $request, $idAdresse)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $em = $this->getDoctrine()->getManager();
        $adresse = $idAdresse;
        $user = $this->getUser();
        if ($adresse == 0){
            $adresse = new DeliveryAdressUser();
            $adresse->setAdresse($user->getAdresse());
            $adresse->setCodePostal($user->getCodePostal());
            $adresse->setVille($user->getVille());
            $adresse->setPays($user->getPays());
            $adresse->setNom($user->getNom());
            $adresse->setPrenom($user->getPrenom());
            $adresse->setTel($user->getPhoneNumber());
        }else
        {
            $adresse = $em->getRepository(DeliveryAdressUser::class)
                ->find($idAdresse);
            if ($adresse->getUser()->getId() != $user->getId()){
                return $this->redirectToRoute('panier');
            }
        }
        $session = $request->getSession();
        if (!($session->has('panier')))
        {
            return $this->redirectToRoute('panier');
        }else{
            $arrayPanier = $session->get('panier');
            $panier = new Panier();
            $panier->setPanier($arrayPanier);
        }
        $sortPanier = $panier->sortPanier();
        if (count($sortPanier) == 0)
            return $this->redirectToRoute('panier');
        $prixTotal = 0;
        $produits = array();
        foreach ($sortPanier as $key => $produit){
            $produits[] = $em->getRepository(ProduitIntern::class)
                ->find($produit[0]);
            $prixTotal += $produits[$key]->getPrixVentes() * $produit[3];
        }
        return $this->render('payement.html.twig', array(
            'adresse' => $adresse,
            'paniers' => $sortPanier,
            'user' => $user,
            'produits' => $produits,
            'prix_total' => $prixTotal,
        ));
    }
}
