<?php

namespace App\Controller;

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
    public function login(Request $request, AuthenticationUtils $authenticationUtils)
    {
        //pour récuperer l'erreur si il y en a une
        $error = $authenticationUtils->getLastAuthenticationError();

        //Récupere le dernier username entré par l'utilisateur
        $lastUsername = $authenticationUtils->getLastUsername();


        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error,
        ));
    }
}
