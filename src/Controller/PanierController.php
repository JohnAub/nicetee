<?php

namespace App\Controller;

use App\Entity\Panier;
use App\Entity\ProduitIntern;
use function PHPSTORM_META\elementType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PanierController extends Controller
{



    /**
     * @Route("/panier", name="panier")
     */
    public function panier(Request $request)
    {
        $session = $request->getSession();
        if (!$session->has('panier')) $session->set('panier', Panier::class);



        $panier = $session->get('panier');
        dump($panier);
        $em = $this->getDoctrine()->getManager();
        //todo voir comment récuperer produitintern et membre en meme temps
        $sortPanier = $panier->sortPanier();

        $prixTotal = 0;
        if ($sortPanier){
            $produits = array();
            foreach ($sortPanier as $key => $produit){
                $produits[] = $em->getRepository(ProduitIntern::class)
                    ->find($produit[0]);
                $prixTotal += $produits[$key]->getPrixVentes() * $produit[3];
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
                    die('ici');
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
                if (!($session->has('panier')))
                {
                    $panier = new Panier();
                    $session->set('panier', $panier);
                }else{
                    $panier = $session->get('panier');
                }

                $panier->ajouterProduit($id, $sex, $taille, $qty);
                //On récupere la session
               /* $session = $request->getSession();

                //on vérifie que dans notre session on est bien un array panier sinon on le cree
                if (!($session->has('panier')))
                {
                    $session->set('panier', array());
                }

                //on stock la variable session panier dans $panier pour plus de simplicité
                $panier = $session->get('panier');

                //On ajoute au panier
                $panier[$id][$sex][$taille] = array(
                    'qty' => $qty
                );*/

                $session->set('panier', $panier);


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
     * @Route("/product/{id}/panier/suprimer", name="remove_panier_produit")
     */
    public function supprimer($id, Request $request)
    {
        $sex = $request->get('sex');
        $taille = $request->get('taille');
        $session = $request->getSession();
        if (!$session->has('panier')) $session->set('panier', array());
        $panier = $session->get('panier');
        $panier->removeProduit($id, $sex, $taille);
        $session->set('panier', $panier);
        return $this->panier($request);

    }
}
