<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;


class UserController extends Controller
{
    /**
     * @Route("/user", name="user")
     */
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user = new User();
        $user->setFullName('Toroto');
        $user->setUsername('Renée');
        $user->setAdresse('Le Pineteau');
        $user->setVille('Montrottier');
        $user->setCodePostal(69770);
        $user->setPassword('azerty123456');

        $entityManager->persist($user);

        $entityManager->flush();
        return new Response("sauvgardé avec l'id: ".$user->getId());
    }

    /**
     * @Route("/user/{id}", name="product_show")
     */
    public function showAction($id)
    {
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        return $this->render('User.html.twig', array(
            'user' => $user
        ));

        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }
}
