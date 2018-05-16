<?php

namespace App\Entity;

use Doctrine\ORM\EntityManager;

class Panier
{
    private $panier;
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->panier = array();
        $this->em = $em;
    }

    public function sortPanier(){
        $ids = $this->getIds();
        $tab = array();
        if ($ids){
            foreach($ids as $idValue) {
                $sexs = array_keys($this->panier[$idValue]);
                $countSex = count($sexs);
                for ($s = 0; $s < $countSex; $s++) {
                    $tailles = array_keys($this->panier[$idValue][$sexs[$s]]);
                    $countTailles = count($tailles);
                    for ($t = 0; $t < $countTailles; $t++) {
                        $qty = $this->panier[$idValue][$sexs[$s]][$tailles[$t]]['qty'];
                        $tab[] = array($idValue, $sexs[$s], $tailles[$t], $qty);
                    }
                }
            }
        }
        return $tab;
    }

    public function ajouterProduit($id, $sex, $taille, $qty){
        $this->panier[$id][$sex][$taille] = array('qty' => $qty);
    }

    public function getIds(){
        if (!empty($this->panier))
            return array_keys($this->panier);
        return null;
    }

    public function removeProduit($id, $sex, $taille){
        if (isset($this->panier[$id][$sex][$taille])){
            unset($this->panier[$id][$sex][$taille]);
            return $this->panier;
        }else{
            return false;
        }
    }

    /**
     * @return mixed
     */
    public function getPanier()
    {
        return $this->panier;
    }

    /**
     * @param array $panier
     */
    public function setPanier(array $panier)
    {
        $this->panier = $panier;
    }

    public function getProducts(){
        $sortPanier = $this->sortPanier();
        $products = array();
        foreach ($sortPanier as $produit){
            $product = $this->returnProduct($produit);
            $products[] = array(
                "designation" => $product->getDesignation(),
                "sex" => $produit[1],
                "taille" => $produit[2],
                "qty" => $produit[3],
                "prixUnitaire" =>$product->getPrixventes(),
            );
        }
        return $products;
    }

    public function addCommande(User $user, $idSale, $idAdresse){
        $em = $this->em;
        $sortPanier = $this->sortPanier();
        $commande = new Commande();
        foreach ($sortPanier as $produit){
            $product = $this->returnProduct($produit);
            $ligneCommande = new LigneCommande();
            $ligneCommande->setPrix($product->getPrixventes());
            $ligneCommande->setQty($produit[3]);
            $id = $produit[0];
            if (preg_match('#m#i', $id)){
                $ligneCommande->setProduitMembre($product);
                $ligneCommande->setTypeProduit(2);
                $product->crediterMembre($produit[3], $em);
            }else
            {
                $ligneCommande->setProduitInterne($product);
                $ligneCommande->setTypeProduit(1);
            }
            $ligneCommande->setSex($produit[1]);
            $ligneCommande->setTaille($produit[2]);
            $commande->addLigneCommande($ligneCommande);
            $em->persist($ligneCommande);
        }
        $user->addCommandes($commande);
        $commande->setIdSale($idSale);
        $commande->setIdAdresse($idAdresse);
        $em->persist($commande);
        $em->flush();
        return $commande->getId();
    }

    public function getPrice(){
        $sortPanier = $this->sortPanier();
        $price = 0;
        foreach ($sortPanier as $produit){
            $product = $this->returnProduct($produit);
            $price += $product->getPrixVentes() * $produit[3];
        }
        return $price;
    }

    public function getVatPrice($rate){
        return round($this->getPrice() * $rate * 100) / 100;
    }

    private function returnProduct($produit){
        $em = $this->em;
        $id = $produit[0];
        if (preg_match('#m#i', $id)){
            $id = substr($id,1);
            $product = $em->getRepository(ProduitMembre::class)
                ->find($id);
        }else{
            $product = $em->getRepository(ProduitIntern::class)
                ->find($id);
        }
        return $product;
    }
}

