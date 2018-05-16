<?php

namespace App\Controller;

use App\Entity\Commande;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class PdfController extends Controller
{

    /**
     * @param $idCommande
     * @return Response
     * @Route("/pdf/commande/{idCommande}", name="pdf_commande")')
     */
    public function pdfCommande($idCommande){
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $commande = $em->getRepository(Commande::class)
            ->find($idCommande);
        $userCommande = $commande->getUser();

        if($user == $userCommande){
            $products = $commande->getProducts();
            if ($commande->getIdAdresse() == 0){
                $adresseLivraison = $user->getCompletAdress();
            }else{
                $adresseLivraison = $user->getDeliveryAdressById($commande->getIdAdresse());
            }

            return $this->render('pdf_commande.html.twig', array(
                'commande' => $commande,
                'products' => $products,
                'adresse' => $adresseLivraison
            ));
        }
        return $this->redirectToRoute('acceuil');

    }

    /**
     * @param $idCommande
     * @param AuthorizationCheckerInterface $authChecker
     * @return Response
     * @Route("/pdf/preparation/commande/{idCommande}", name="pdf_preparation_commande")')
     */
    public function pdfPreparationCommande($idCommande, AuthorizationCheckerInterface $authChecker){
        if (false === $authChecker->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException('Unable to access this page!');
        }
        $em = $this->getDoctrine()->getManager();
        $commande = $em->getRepository(Commande::class)
            ->find($idCommande);
        $userCommande = $commande->getUser();
        $products = $commande->getProducts();
        if ($commande->getIdAdresse() == 0){
            $adresseLivraison = $userCommande->getCompletAdress();
        }else{
            $adresseLivraison = $userCommande->getDeliveryAdressById($commande->getIdAdresse());
        }
        return $this->render('pdf_commande.html.twig', array(
            'userCommande' => $userCommande,
            'commande' => $commande,
            'products' => $products,
            'adresse' => $adresseLivraison
        ));
    }

}

