<?php

namespace App\Controller;

use App\Entity\ChangePassword;
use App\Entity\Commande;
use App\Entity\DeliveryAdressUser;
use App\Entity\Dessin;
use App\Entity\Portefeuille;
use App\Entity\ProduitIntern;
use App\Form\ChangePasswordType;
use App\Form\UserInfosType;
use App\Form\UserpassType;
use App\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserController extends Controller
{

    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscriptionAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // on instancie un user et on cree le formulaire grace au UserType et on lui indique qu'on utilise le $user que l'on vient de cree
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        //on recup les info du formulaire
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            // on encode le pass et on utilise le PlainPassword temporaire l'encodage a été defini dans security.yaml
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $user->eraseCredentials();
            //on enregistre le nouveau user en bdd
            $em = $this->getDoctrine()->getManager();
            //on lui cree un Portefeuille
            $portefeuille = new Portefeuille();
            $portefeuille->setUser($user);
            $user->setPortefeuille($portefeuille);
            $em->persist($user);
            $em->persist($portefeuille);
            $em->flush();
            return $this->redirectToRoute('user_validatation', array('id' => $user->getId()));
        }
        return $this->render('inscription.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/welcome/{id}", name="user_validatation")
     */
    public function UserValidationInscription($id)
    {
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($id);
        if (!$user) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        return $this->render('user_validation_welcom.html.twig', array(
            'user' => $user,
        ));
    }

    /**
     * @Route("/user/{id}", name="page_user")
     */
    public function UserPage($id)
    {
        $userPage = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($id);
        if (!$userPage) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        $user = $this->getUser();
        $pagePerso = ($userPage == $user)? true : false;
        $dessins = $this->getDoctrine()
            ->getRepository(Dessin::class)
            ->findByUser($id);
        return $this->render('User.html.twig', array(
            'user' => $userPage,
            'dessins' => $dessins,
            'pagePerso' => $pagePerso
        ));
    }


    /**
     * @Route("/user/{id}/infos", name="page_user_infos")
     */
    public function UserPageInfo($id, Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $em = $this->getDoctrine()->getManager();
        $userPage = $em
            ->getRepository(User::class)
            ->find($id);
        if (!$userPage) {
            throw $this->createNotFoundException(
                'No user found for id '.$id
            );
        }
        $user = $this->getUser();
        $pagePerso = ($userPage == $user)? true : false;
        $formInfos = $this->createForm(UserInfosType::class, $user);
        $changePasswordModel = new ChangePassword();
        $formPass = $this->createForm(ChangePasswordType::class, $changePasswordModel);
        $formPass->handleRequest($request);
        $formInfos->handleRequest($request);
        if ($formInfos->isSubmitted() && $formInfos->isValid()){
            $em->flush();
            return $this->redirectToRoute('page_user_infos', array('id' => $user->getId()));
        }
        if ($formPass->isSubmitted() && $formPass->isValid()) {
            // perform some action,
            // such as encoding with MessageDigestPasswordEncoder and persist
            $this->addFlash(
                'notice',
                'Votre mot de passe actuel ne coresponde pas'
            );
            return $this->redirectToRoute('page_user_infos', array('id' => $user->getId()));
        }
        return $this->render('user_infos.html.twig', array(
            'user' => $userPage,
            'pagePerso' => $pagePerso,
            'formInfos' => $formInfos->createView(),
            'formPass' => $formPass->createView(),
        ));
    }

    /**
     * @Route("user/{id}/portefeuille", name="user_portefeuille")
     */
    public function UserPortefeuille(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $userPage = $em
            ->getRepository(User::class)
            ->find($id);
        if (!$userPage) {
            throw $this->createNotFoundException(
                'No user found for id '.$id
            );
        }
        $user = $this->getUser();
        $pagePerso = ($userPage == $user)? true : false;
        $portefeuille = "";
        $operations = "";
        if ($pagePerso == true){
            $portefeuille = $user->getPortefeuille();
            $operations = $portefeuille->getOperations();
            $credit = "";
            foreach ($operations as $operation){
                $credit += $operation->getMontant();
            }
            $portefeuille->setSolde($credit);
        }
        return $this->render('user_portefeuille.html.twig', array(
            'user' => $userPage,
            'pagePerso' => $pagePerso,
            'portefeuille' => $portefeuille,
            'operations' => $operations,
        ));
    }

    /**
     * @Route("user/{id}/commande", name="user_commande")
     */
    public function UserCommande(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $userPage = $em
            ->getRepository(User::class)
            ->find($id);
        if (!$userPage) {
            throw $this->createNotFoundException(
                'No user found for id '.$id
            );
        }
        $user = $this->getUser();
        $pagePerso = ($userPage == $user)? true : false;
        $commandes = $user->getCommandes();
        $lignesCommandes = array();
        foreach ($commandes as $commande){
            $lignesCommandes[] = $commande->getLigneCommandes();
        }
        return $this->render('user_commande.html.twig', array(
            'user' => $userPage,
            'pagePerso' => $pagePerso,
            'commandes' => $commandes,
            'lignesCommandes' => $lignesCommandes
        ));
    }

    /**
     * @Route("user/{id}/commande/{idCommande}", name="user_commande_detail")
     */
    public function UserCommandeDetail(Request $request, $id, $idCommande)
    {
        $em = $this->getDoctrine()->getManager();
        $userPage = $em
            ->getRepository(User::class)
            ->find($id);
        if (!$userPage) {
            throw $this->createNotFoundException(
                'No user found for id '.$id
            );
        }
        $user = $this->getUser();
        $pagePerso = ($userPage == $user)? true : false;
        $commande = $em->getRepository(Commande::class)
            ->find($idCommande);
        $lignesCommande = $commande->getLigneCommandes();
        $produits = array();
        foreach ($lignesCommande as $ligneCommande){
            if ($ligneCommande->getTypeProduit() == 1){
                $produits[] = $ligneCommande->getProduitInterne();
            }else{
                $produits[] = $ligneCommande->getProduitMembre();
            }
        }
        if ($commande->getIdAdresse() == 0){
            $adresse = $user->getCompletAdress();
        }else{
            $adresse = $em->getRepository(DeliveryAdressUser::class)
                ->find($commande->getIdAdresse());
        }
        return $this->render('user_commande_detail.html.twig', array(
            'user' => $userPage,
            'pagePerso' => $pagePerso,
            'commande' => $commande,
            'lignesCommandes' => $lignesCommande,
            'produits' => $produits,
            'adresse' => $adresse
        ));
    }

    /**
     * @Route("user/{id}/removeDessin")
     */
    public function RemoveDessin(Request $request, $id)
    {
        if($request->isXmlHttpRequest())
        {
            if ($this->isGranted('ROLE_USER') || $this->isGranted('ROLE_ADMIN'))
            {
                $user = $this->getUser();
                if ($user->getId() == $id)
                {
                    $idDessin = $request->request->get('id_dessin');
                    $dessin = $this->getDoctrine()
                        ->getRepository(Dessin::class)
                        ->find($idDessin);
                    if ($dessin){
                        $user->removeDessin($dessin);
                        $em = $this->getDoctrine()->getManager();
                        $em->persist($user);
                        $em->flush();
                        $resp = "Le dessin à été suprimé";
                    }else{
                        $resp = "Désolé une ereur s'est produite";
                    }
                    $response = new JsonResponse();
                    $response->setData(array(
                        "resp"=> $resp,
                    ));
                    return $response;
                }
            }
        }
            throw new \Exception("Erreur");
    }
}

