<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Entity\Dessin;
use App\Entity\User;
use App\Entity\Votes;
use App\Form\CommentaireType;
use App\Form\SubmitDessinType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @Route("/dessin/{id}", name="page_dessin")
     */
    public function pageDessin($id, AuthorizationCheckerInterface $authChecker,Request $request)
    {
        $authOk = ($authChecker->isGranted('ROLE_USER') || $authChecker->isGranted('ROLE_ADMIN')) ? true :false;

        $dessin = $this->getDoctrine()
            ->getRepository(Dessin::class)
            ->find($id);
        $commentaires = $this->getDoctrine()
            ->getRepository(Commentaire::class)
            ->findBy(
                array('dessin' => $id),
                array('date' => 'desc')
                );
        if (!empty($commentaires))
        {
            foreach ($commentaires as $commentaire){
                $userId = $commentaire->getAuteur();
                $text = $commentaire->getCommentaire();
                $date = $commentaire->getDate();
                $user = $this->getDoctrine()
                    ->getRepository(User::class)
                    ->find($userId);
                $userName = $user->getUsername();
                $comms[] = array(
                    "userName" => $userName,
                    "userId" => $userId,
                    "commentaire" => $text,
                    "date" => $date,
                );
            }
        }else
        {
            $comms = "";
        }
        if ($authOk){
            $commentaire = new Commentaire();
            $form = $this->createForm(CommentaireType::class, $commentaire);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()){
                $user = $this->getUser();
                $userId = $user->getId();
                $commentaire->setAuteur($userId);
                $dessin->addCommentaire($commentaire);
                $em = $this->getDoctrine()->getManager();
                $em->persist($commentaire);
                $em->flush();
                return $this->redirectToRoute('page_dessin',array(
                    'id' => $id,
                ));
            }
            return $this->render('pageDessin.html.twig', array(
                'dessin' => $dessin,
                'autOk' => $authOk,
                'commentaires' => $comms,
                'form' => $form->createView()
            ));
        }
        return $this->render('pageDessin.html.twig', array(
            'dessin' => $dessin,
            'autOk' => $authOk,
            'commentaires' => $comms,
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

    /**
     * @Route("/vote/addVote", name="add_vote")
     * @Route("/vote/vote/addVote")
     * @Route("/dessin/vote/addVote")
     */
    public function addVote(Request $request){
        if($request->isXmlHttpRequest())
        {

            if ($this->isGranted('ROLE_USER') || $this->isGranted('ROLE_ADMIN'))
            {
                $em = $this->getDoctrine()->getManager();
                $idDessin = $request->request->get('id_dessin');
                $user = $this->getUser();
                $idUser = $user->getId();
                $dessin = $em->getRepository(Dessin::class)
                    ->find($idDessin);
                $votes = $em->getRepository(Votes::class)
                    ->findByDessin($idDessin);
                $dejaVote = false;
                if (!empty($votes)){
                    foreach ($votes as $vote){
                        if ($idUser == $vote->getIdUser()){
                            $dejaVote = true;
                        }
                    }
                }
                if ($dejaVote == false){
                    $vote = new Votes();
                    $vote->setIdUser($idUser);
                    $nbrVotes = count($votes);
                    $nbrVotes++;
                    $dessin->setNbrVotes($nbrVotes);
                    $dessin->addVotes($vote);
                    $em->persist($vote);
                    $em->flush();
                }else{
                    $nbrVotes = count($votes);
                }

                $response = new JsonResponse();
                $response->setData(array(
                    "nbr"=>$nbrVotes,
                    "dejaVote"=>$dejaVote
                ));
                return $response;
            }else
            {
                $response = new JsonResponse();
                $response->setData(array(
                    "noCo"=>"noCo"
                ));
                return $response;
            }
        }else{
            throw new \Exception("Erreur");
        }
    }
}

