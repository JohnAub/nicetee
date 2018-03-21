<?php

namespace App\Controller;

use App\Entity\Dessin;
use App\Form\SubmitDessinType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class DessinController extends Controller
{


    /**
     * @Route("/submit-design", name="submit_design")
     */
    public function submitDessin(Request $request, SecurityController $securityController, AuthenticationUtils $authenticationUtils,AuthorizationCheckerInterface $authChecker)
    {
        if ($authChecker->isGranted('ROLE_USER') || $authChecker->isGranted('ROLE_ADMIN')){
            $user = $this->getUser();
            $dessin = new Dessin();
            $form = $this->createForm(SubmitDessinType::class, $dessin);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()){
                $user->addDessin($dessin);
                $em = $this->getDoctrine()->getManager();
                $em->persist($dessin);
                $em->flush();
                return $this->redirectToRoute('dessin_test', array('id' => $dessin->getId()));
            }
            return $this->render('dessin.html.twig', array(
                'form' => $form->createView()
            ));
        }
        $connection = $securityController->loginDessin($authenticationUtils);
        $lastUsername = $connection["last_username"];
        $error = $connection["error"];
        return $this->render('dessinConnection.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error,
        ));


    }

    /**
     * @Route("/test/{id}", name="dessin_test")
     */
    public function dessinAddValidate($id) //todo envoyer sur le compte user section dessins
    {
        $dessin = $this->getDoctrine()
            ->getRepository(Dessin::class)
            ->find($id);

        return $this->render('dessinAddOk.html.twig', array(
            'dessin' => $dessin,
        ));
    }

    /**
     * @Route("/vote", name="tee_vote")
     */
    public function teeVote()
    {
        $dessins = $this->getDoctrine()
            ->getRepository(Dessin::class)
            ->findAll();
        shuffle($dessins); // Utilisation du shuffle pour rendre le rendu aléatoire. Ok pour une petite bibliotheque
                           // mais si deviens trop lourd, il y a une extensoin pour doctrine qui ajoute rand() pour le Query:
                           // $query->addSelect('column')->orderBy('RAND()');

        return $this->render('vote.html.twig', array(
            "dessins" => $dessins,
        ));
    }
    /**
     * @Route("/vote/popular", name="tee_vote_popular")
     */
    public function teeVotePopular()
    {
        $dessins = $this->getDoctrine()
            ->getRepository(Dessin::class)
            ->findBy(
                array(),
                array('nbrVotes' => 'desc')
            );
        return $this->render('vote.html.twig', array(
            "dessins" => $dessins,
        ));
    }
}
