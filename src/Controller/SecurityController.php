<?php

namespace App\Controller;

use App\Entity\ProduitIntern;
use App\Entity\ProduitMembre;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        $listTeeIntern = $this->getDoctrine()
            ->getRepository(ProduitIntern::class)
            ->findAll();
        $listTeeUser = $this->getDoctrine()
            ->getRepository(ProduitMembre::class)
            ->findBy(
                array("visibilite" => "true"),
                array("dateAjout" => "desc"),
                3,
                0
            );
        $this->addFlash("error", "Vous devez être connecté ou creer un compte");
        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error,
            'teeIntern' => $listTeeIntern,
            'teeMembre' => $listTeeUser
        ));
    }


    public function loginDessin(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return array(
            'last_username' => $lastUsername,
            'error' => $error,
        );
    }
}

