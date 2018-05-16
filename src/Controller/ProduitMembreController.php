<?php

namespace App\Controller;

use App\Entity\ProduitIntern;
use App\Entity\ProduitMembre;
use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ProduitMembreController extends Controller
{
    /**
     * @Route("/productuser/{id}", name="tee_membre_node")
     */
    public function indexAction($id)
    {
        $tee = $this->getDoctrine()
            ->getRepository(ProduitMembre::class)
            ->find($id);
        if (!$tee){
            throw $this->createNotFoundException(
                "Pas de Tee trouver avec l'id ".$id
            );
        }
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($tee->getIdUser());
        $listTeeIntern = $this->getDoctrine()
            ->getRepository(ProduitIntern::class)
            ->findAll();
        $listTeeUser = $this->getDoctrine()
            ->getRepository(ProduitMembre::class)
            ->findBy(
                array("visibilite" => "true"),
                array("dateAjout" => "asc"),
                3,
                0
            );
        foreach ($listTeeUser as $teeUser){
            $user = $this->getDoctrine()
                ->getRepository(User::class)
                ->find($teeUser->getIdUser());
            $teeUser->setIdUser($user->getUsername());
        }

        return $this->render('teeNode.html.twig', array(
            'intern' => false,
            'tee' => $tee,
            'user' => $user,
            'teeIntern' => $listTeeIntern,
            'teeMembre' => $listTeeUser
        ));
    }
}

