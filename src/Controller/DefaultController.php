<?php

namespace App\Controller;

use App\Entity\ProduitIntern;
use App\Entity\ProduitMembre;
use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="acceuil")
     */
    public function default(Request $request)
    {
      $session = $request->getSession();
      $session->clear();
      $listTeeIntern = $this->getDoctrine()
            ->getRepository(ProduitIntern::class)
            ->findAll();
      shuffle($listTeeIntern);
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
        return $this->render('base.html.twig', array(
            'teeIntern' => $listTeeIntern,
            'teeMembre' => $listTeeUser
        ));
    }

    /**
     * @Route("/test")
     */
    public function test()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }
}

