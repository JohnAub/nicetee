<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LigneCommandeRepository")
 */
class LigneCommande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Commande", inversedBy="ligneCommandes")
     * @ORM\JoinColumn(nullable=true)
     */
    private $commande;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ProduitIntern", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $produitInterne;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Commande", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $produitMembre;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $qty;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    private $prix;



    /***************Getter-Setter*****************/


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */

    /**
     * @return mixed
     */
    public function getCommande()
    {
        return $this->commande;
    }

    /**
     * @param mixed $commande
     */
    public function setCommande($commande)
    {
        $this->commande = $commande;
    }

    /**
     * @return int
     */
    public function getQty(): int
    {
        return $this->qty;
    }

    /**
     * @param int $qty
     */
    public function setQty(int $qty)
    {
        $this->qty = $qty;
    }

    /**
     * @return float
     */
    public function getPrix(): float
    {
        return $this->prix;
    }

    /**
     * @param float $prix
     */
    public function setPrix(float $prix)
    {
        $this->prix = $prix;
    }

    /**
     * @return mixed
     */
    public function getProduitInterne()
    {
        return $this->produitInterne;
    }

    /**
     * @param mixed $produitInterne
     */
    public function setProduitInterne($produitInterne)
    {
        $this->produitInterne = $produitInterne;
    }

    /**
     * @return mixed
     */
    public function getProduitMembre()
    {
        return $this->produitMembre;
    }

    /**
     * @param mixed $produitMembre
     */
    public function setProduitMembre($produitMembre)
    {
        $this->produitMembre = $produitMembre;
    }


}
