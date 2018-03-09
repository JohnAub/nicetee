<?php

namespace App\Entity;

use App\Model\Produit;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProduitInternRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 */
class ProduitIntern extends Produit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $fournisseur;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    private $prixAchat;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    private $tauxVente;

    public function __construct($prixAchat, $tauxVente)
    {
        $this->prixAchat = $prixAchat;
        $prixVentesht = $this->prixAchat * $tauxVente;
        parent::__construct($prixVentesht);
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getFournisseur(): string
    {
        return $this->fournisseur;
    }

    /**
     * @param string $fournisseur
     */
    public function setFournisseur(string $fournisseur)
    {
        $this->fournisseur = $fournisseur;
    }

    /**
     * @return float
     */
    public function getPrixAchat(): float
    {
        return $this->prixAchat;
    }

    /**
     * @param float $prixAchat
     */
    public function setPrixAchat(float $prixAchat)
    {
        $this->prixAchat = $prixAchat;
    }

    /**
     * @return float
     */
    public function getTauxVente(): float
    {
        return $this->tauxVente;
    }

    /**
     * @param float $tauxVente
     */
    public function setTauxVente(float $tauxVente)
    {
        $this->tauxVente = $tauxVente;
    }



}
