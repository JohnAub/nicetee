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
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $prixAchat;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
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
     * @return int
     */
    public function getPrixAchat(): int
    {
        return $this->prixAchat;
    }

    /**
     * @param int $prixAchat
     */
    public function setPrixAchat(int $prixAchat)
    {
        $this->prixAchat = $prixAchat;
    }

    /**
     * @return int
     */
    public function getTauxVente(): int
    {
        return $this->tauxVente;
    }

    /**
     * @param int $tauxVente
     */
    public function setTauxVente(int $tauxVente)
    {
        $this->tauxVente = $tauxVente;
    }



}
