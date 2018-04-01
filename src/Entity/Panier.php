<?php

namespace App\Entity;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Panier
{
    private $panier;

    public function __construct($session)
    {
        $this->panier = $session->get('panier');
    }

    public function sortPanier(){
        $ids = array_keys($this->panier);
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

    public function getIds(){
        return array_keys($this->panier);
    }
}