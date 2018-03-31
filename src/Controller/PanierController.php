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
        if (!$session->has('panier')) $session->set('panier', array());
        $panier = new Panier($session);
        $em = $this->getDoctrine()->getManager();
        //todo voir comment récuperer produitintern et membre en meme temps
        /*$produits = $em->getRepository(ProduitIntern::class)
            ->findArray($panier->getIds());*/
        $sortPanier = $panier->sortPanier();
        $produits = array();
        foreach ($sortPanier as $produit){
            $produits[] = $em->getRepository(ProduitIntern::class)
                ->find($produit[0]);
        }
        dump($produits);
        dump($sortPanier);

        return $this->render('panier.html.twig', array(
            "produits" => $produits,
            "paniers" => $sortPanier
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
                $tailleSex = $request->request->get('taille_sex');
                $tailleSex = explode('-', $tailleSex);
                $sex = $tailleSex['0'];
                $taille = $tailleSex['1'];
                $qty = $request->request->get('qty');
                $em = $this->getDoctrine()->getManager();
                $product = $em->getRepository(ProduitIntern::class)
                    ->find($id);

              /*  if ( empty($product) || $sex != 'H' ||$sex != 'F' || $taille != 'S' || $taille != 'M' ||
                    $taille != 'L' || $taille != 'XL' || $taille != 'XXL' ||
                    is_nan($qty) || $qty <= 0 )
                {
                    die( "Un problème est survenu pendant l'ajout au panier" );
                }*/

                $productName = $product->getDesignation();
                //On récupere la session
                $session = $request->getSession();

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
                );
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


    public function supprimer($id)
    {

    }

}
