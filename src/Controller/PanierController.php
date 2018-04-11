<?php

namespace App\Controller;

use App\Entity\Panier;
use App\Entity\ProduitIntern;
use App\Entity\ProduitMembre;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PanierController extends Controller
{



    /**
     * @Route("/panier", name="panier")
     */
    public function panier(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        if (!($session->has('panier')))
        {
            $panier = new Panier($em);
            $arrayPanier = $panier->getPanier();
            $session->set('panier', $arrayPanier);
        }else{
            $arrayPanier = $session->get('panier');
            $panier = new Panier($em);
            $panier->setPanier($arrayPanier);
        }

        //todo voir comment récuperer produitintern et membre en meme temps
        $sortPanier = $panier->sortPanier();

        $prixTotal = 0;
        if ($sortPanier){
            $produits = array();
            foreach ($sortPanier as $key => $produit){
                $id = $produit[0];
                if (preg_match('#m#i', $id)){
                    $id = substr($id,1);
                    $produits[] = $em->getRepository(ProduitMembre::class)
                        ->find($id);
                    $prixTotal += $produits[$key]->getPrixVentes() * $produit[3];
                }else{
                    $produits[] = $em->getRepository(ProduitIntern::class)
                        ->find($produit[0]);
                    $prixTotal += $produits[$key]->getPrixVentes() * $produit[3];
                }
            }
            return $this->render('panier.html.twig', array(
                'vide' => false,
                'prix_total' => $prixTotal,
                "produits" => $produits,
                "paniers" => $sortPanier
            ));
        };
        return $this->render('panier.html.twig', array(
        "vide" => true,
    ));
    }

    /**
     * @Route("/product/{id}/panier", name="add_panier_produit_intern")
     */
    public function ajouter(Request $request,$id)
    {
        if($request->isXmlHttpRequest())
        {
            if ($id)
            {
                if ($request->request->get('ajouter') == 1){
                    $sex = $request->request->get('sex');
                    $taille = $request->request->get('taille');
                    $qty = $request->request->get('qty');
                }else{
                    $tailleSex = $request->request->get('taille_sex');
                    $tailleSex = explode('-', $tailleSex);
                    $sex = $tailleSex['0'];
                    $taille = $tailleSex['1'];
                    $qty = $request->request->get('qty');
                }
                $em = $this->getDoctrine()->getManager();
                $product = $em->getRepository(ProduitIntern::class)
                    ->find($id);

                $productName = $product->getDesignation();
                $session = $request->getSession();

                //On serialize en json le panier pour le stocker en session

                if (!($session->has('panier')))
                {
                    $panier = new Panier($em);
                    $panier->ajouterProduit($id, $sex, $taille, $qty);
                    $arrayPanier = $panier->getPanier();
                    $session->set('panier', $arrayPanier);
                }else{
                    $arrayPanier = $session->get('panier');
                    $panier = new Panier($em);
                    $panier->setPanier($arrayPanier);
                    $panier->ajouterProduit($id, $sex, $taille, $qty);
                    $arrayPanier = $panier->getPanier();
                    $session->set('panier', $arrayPanier);
                }

                //************************************//
                $response = new JsonResponse();
                $response->setData(array(
                    "taille" => $taille,
                    "sex" => $sex,
                    "qtys" => $qty,
                    "productName" => $productName
                ));
                return $response;

            }else
            {
                die("Vous n'avez pas sélectionné de produit à ajouter au panier");
            }
        }
        throw new \Exception("Erreur");
    }

    /**
     * @Route("/productuser/{id}/panier", name="add_panier_produit_membre")
     */
    public function ajouterProductUser(Request $request,$id)
    {
        if($request->isXmlHttpRequest())
        {
            if ($id)
            {
                if ($request->request->get('ajouter') == 1){ //Modif depuis le panier
                    $sex = $request->request->get('sex');
                    $taille = $request->request->get('taille');
                    $qty = $request->request->get('qty');
                }else{                                          //ajout depuis node
                    $tailleSex = $request->request->get('taille_sex');
                    $tailleSex = explode('-', $tailleSex);
                    $sex = $tailleSex['0'];
                    $taille = $tailleSex['1'];
                    $qty = $request->request->get('qty');
                }
                if (preg_match('#m#i', $id))
                {
                    $id = substr($id, 1);
                }
                $em = $this->getDoctrine()->getManager();
                $product = $em->getRepository(ProduitIntern::class)
                    ->find($id);

                $productName = $product->getDesignation();
                $id = 'M'.$id;
                $session = $request->getSession();

                if (!($session->has('panier')))
                {
                    $panier = new Panier($em);
                    $panier->ajouterProduit($id, $sex, $taille, $qty);
                    $arrayPanier = $panier->getPanier();
                    $session->set('panier', $arrayPanier);
                }else{
                    $arrayPanier = $session->get('panier');
                    $panier = new Panier($em);
                    $panier->setPanier($arrayPanier);
                    $panier->ajouterProduit($id, $sex, $taille, $qty);
                    $arrayPanier = $panier->getPanier();
                    $session->set('panier', $arrayPanier);
                }

                //************************************//
                $response = new JsonResponse();
                $response->setData(array(
                    "taille" => $taille,
                    "sex" => $sex,
                    "qtys" => $qty,
                    "productName" => $productName
                ));
                return $response;

            }else
            {
                die("Vous n'avez pas sélectionné de produit à ajouter au panier");
            }
        }
        throw new \Exception("Erreur");

    }

    /**
     * @Route("/{id}/panier/suprimer", name="remove_panier_produit")
     */
    public function supprimer($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $sex = $request->get('sex');
        $taille = $request->get('taille');
        $session = $request->getSession();
        if (!$session->has('panier')) $session->set('panier', array());
        $arrayPanier = $session->get('panier');
        $panier = new Panier($em);
        $panier->setPanier($arrayPanier);
        $panier->removeProduit($id, $sex, $taille);
        $arrayPanier = $panier->getPanier();
        $session->set('panier', $arrayPanier);
        return $this->panier($request);

    }

    /**
     * @Route("/product/panier/vider", name="remove_panier_full")
     */
    public function vider( Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        if (!$session->has('panier')) $session->set('panier', array());
        $panier = new Panier($em);
        $arrayPanier = $panier->getPanier();
        $session->set('panier', $arrayPanier);
        return $this->panier($request);

    }
}
