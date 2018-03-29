<?php

namespace App\Controller;

use App\Entity\Panier;
use App\Entity\ProduitIntern;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PanierController extends Controller
{



    /*
     * @Route("/panier/produitIntern/{id}", name="add_panier_produit_intern")
     */
   /* public function addPanier(Request $request,$id)
    {
        if ($id){
            $em = $this->getDoctrine()->getManager();
            $product = $em->getRepository(ProduitIntern::class)
                ->find($id);
            if (empty($product)){
                die("Ce produit n'existe pas");
            }
            $session = $request->getSession();
            $panier = new Panier($session);
            dump($panier);
        }else{
            die("Vous n'avez pas sélectionné de produit à ajouter au panier");
        }

        return $this->render('add_panier.html.twig', array(
        ));
    }*/

    /**
     * @Route("/panier/produitIntern/{id}", name="add_panier_produit_intern")
     */
    public function ajouter(Request $request,$id)
    {
        if ($id){
            $em = $this->getDoctrine()->getManager();
            $product = $em->getRepository(ProduitIntern::class)
                ->find($id);
            if (empty($product)){
                die("Ce produit n'existe pas");
            }
            //On récupere la session
            $session = $request->getSession();

            //on vérifie que dans notre seesion on est bien un array panier sinon on le cree
            if (!($session->has('panier')))
            {
                $this->session->set('panier', array());
            }

            //on staock la variable session panier dans $panier pour plus de simplicité
            $panier = $session->get('panier');

            //on vérifie si le produit n'est pas déja dans le panier
            if (array_key_exists($id, $panier))
            {
                //10.30
            }
            dump($panier);
        }else{
            die("Vous n'avez pas sélectionné de produit à ajouter au panier");
        }

        return $this->render('add_panier.html.twig', array(
        ));
    }
    public function supprimer($id)
    {

    }

}
