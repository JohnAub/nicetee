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
                //On va faire 3 boucles avec idValue = id tee
                // on recupere tous les sex qu'il y a dans idValue
                $sexs = array_keys($this->panier[$idValue]);
                //On sait combien de tour il faut fair 1 ou 2 depend du nombre de sex
                $countSex = count($sexs);
                for ($s = 0; $s < $countSex; $s++) {
                    $tailles = array_keys($this->panier[$idValue][$sexs[$s]]);
                    //On compte combien de tour on va devoir fair avec le idValue et le Id Sex
                    $countTailles = count($tailles);
                    for ($t = 0; $t < $countTailles; $t++) {
                        //on recup la qty
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
        $em = $this->em;
        $sortPanier = $this->sortPanier();
        $products = array();
        foreach ($sortPanier as $produit){
            $product = $em->getRepository(ProduitIntern::class)
                ->find($produit[0]);
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

    public function addCommande(User $user, $idSale){
        $em = $this->em;
        $sortPanier = $this->sortPanier();
        $commande = new Commande();
        foreach ($sortPanier as $produit){
            $product = $em->getRepository(ProduitIntern::class)
                ->find($produit[0]);
            $ligneCommande = new LigneCommande();
            $ligneCommande->setPrix($product->getPrixventes());
            $ligneCommande->setQty($produit[3]);
            $ligneCommande->setProduitInterne($product);
            $ligneCommande->setSex($produit[1]);
            $ligneCommande->setTaille($produit[2]);
            $commande->addLigneCommande($ligneCommande);
            $em->persist($ligneCommande);
        }
        $user->addCommandes($commande);
        $commande->setStatus(true);
        $commande->setIdSale($idSale);
        $em->persist($commande);
        $em->flush();
        return $commande->getId();
    }

    public function getPrice(){
        $em = $this->em;
        $sortPanier = $this->sortPanier();
        $price = 0;
        foreach ($sortPanier as $produit){
            $product = $em->getRepository(ProduitIntern::class)
                ->find($produit[0]);
            $price += $product->getPrixVentes() * $produit[3];
        }
        return $price;
    }
    public function getVatPrice($rate){
        return round($this->getPrice() * $rate * 100) / 100;
    }

}