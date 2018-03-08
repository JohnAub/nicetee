<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Model\Produit;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ProduitMembreRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 */
class ProduitMembre extends Produit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="datetime")
     *
     */
    private $dateFinVente;

    /**
     *
     * @ORM\Column(type="integer")
     */
    private $idUser;

    /**
     * @ORM\Column(type="boolean")
     */
    private $visibilite;

    /**
     *
     * @ORM\Column(type="integer")
     */
    private $PrixVenteMembre;



    public function __construct($idUser)
    {
        $this->dateFinVente = $this->getDateAjout()+172800; //todo verifier format date
        $this->idUser = $idUser;
        $this->visibilite = true;
        $this->PrixVenteMembre = 12;
        $prixVentesht = $this->PrixVenteMembre;
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
     * @return mixed
     */
    public function getDateFinVente()
    {
        return $this->dateFinVente;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @return mixed
     */
    public function getVisibilite()
    {
        return $this->visibilite;
    }

}
