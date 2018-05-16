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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fournisseur;

    /**
     * @var float
     *
     * @ORM\Column(type="float", nullable=true)
     */
    private $prixAchat;

    /**
     * @var float
     *
     * @ORM\Column(type="float", nullable=true)
     */
    private $tauxVente;

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
    public function getFournisseur()
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
    public function getPrixAchat()
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
    public function getTauxVente()
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

