<?php

namespace App\Controller;

use App\Entity\ProduitMembre;
use App\Entity\User;
use App\Form\ProduitInternType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Entity\ProduitIntern;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProduitInternController extends Controller
{

    /**
     * @Route("/product/{id}", name="tee_intern_node")
     */
    public function indexAction(Request $request, $id)
    {
        $tee = $this->getDoctrine()
            ->getRepository(ProduitIntern::class)
            ->find($id);
        if (!$tee){
            throw $this->createNotFoundException(
                "Pas de Tee trouver avec l'id ".$id
            );
        }
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
            'intern' => true,
            'tee' => $tee,
            'teeIntern' => $listTeeIntern,
            'teeMembre' => $listTeeUser
        ));
    }

    /**
     * @Route("/shop", name="tee_intern_shop")
     */
    public function ShowTeeIntern(Request $request)
    {

        $listTeeIntern = $this->getDoctrine()
            ->getRepository(ProduitIntern::class)
            ->findAll();

        return $this->render('shop.html.twig', array(
            'teeIntern' => $listTeeIntern,
        ));
    }


}

