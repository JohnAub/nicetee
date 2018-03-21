<?php

namespace App\Controller;

use App\Entity\ProduitIntern;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function default()
    {
      $listTeeIntern = $this->getDoctrine()
            ->getRepository(ProduitIntern::class)
            ->findAll();
      shuffle($listTeeIntern);
        return $this->render('base.html.twig', array(
            'teeIntern' => $listTeeIntern,
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
