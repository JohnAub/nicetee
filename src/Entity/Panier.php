<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Panier
{
    private $panier;



    public function sortPanier(){
        $ids = $this->getIds();
        if ($ids){
            $tab = array();
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
            return $tab;
        }
        return null;
    }
    public function ajouterProduit($id, $sex, $taille, $qty){
        $this->panier[$id][$sex][$taille] = array('qty' => $qty);
    }

    public function getIds(){
        return array_keys($this->panier);
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
     * @param mixed $panier
     */
    public function setPanier($panier)
    {
        $this->panier = $panier;
    }



}