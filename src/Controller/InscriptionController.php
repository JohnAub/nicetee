<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class InscriptionController extends Controller
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function ionscriptionAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // on instancie un user et on cree le formulaire grace au UserType et on lui indique qu'on utilise le $User que l'on vient de cree
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        //on recup les info du formulaire
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            // on encode le pass et on utilise le PlainPassword temporaire l'encodage a été defini dans security.yaml
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            //on enregistre le nouveau user en bdd
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('user_show', array('id' => $user->getId()));
        }



        return $this->render('inscription.html.twig', array(
            'form' => $form->createView()
        ));
    }

}
