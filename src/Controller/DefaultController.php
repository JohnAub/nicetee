<?php

namespace App\Controller;

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
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('App:ProduitIntern')
        ;
        $listTeeIntern = $repository->findAll();
        return $this->render('base.html.twig', array(
            'teeIntern' => $listTeeIntern,
        ));
    }
}
