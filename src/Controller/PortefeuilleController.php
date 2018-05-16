<?php

namespace App\Controller;

use App\Entity\Portefeuille;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class PortefeuilleController extends Controller
{
    /**
     * @Route("/portefeuille", name="portefeuille")
     */
    public function index()
    {
        // replace this line with your own code!
        return $this->render('@Maker/demoPage.html.twig', [ 'path' => str_replace($this->getParameter('kernel.project_dir').'/', '', __FILE__) ]);
    }

    public function createUserPortefeuille($id){
        $em = $this->getDoctrine()->getManager();
        $portefeuille = new Portefeuille();
        $portefeuille->setUser($id);
        $user = $this->getUser();
        $user->setPortefeuille($portefeuille);
        $em->persist($portefeuille);
        $em->flush();
    }
}
