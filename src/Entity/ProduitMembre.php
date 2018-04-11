<?php

namespace App\Entity;

use Doctrine\ORM\EntityManager;
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


    public function __construct()
    {
        $this->visibilite = true;
        parent::__construct();
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

    /**
     * @param mixed $dateFinVente
     */
    public function setDateFinVente($dateFinVente)
    {
        $this->dateFinVente = $dateFinVente;
    }

    /**
     * @param mixed $idUser
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }

    /**
     * @param mixed $visibilite
     */
    public function setVisibilite($visibilite)
    {
        $this->visibilite = $visibilite;
    }


    public function crediterMembre($qty,EntityManager $em):void{
        $idUser = $this->getIdUser();
        $user = $em->getRepository(User::class)
            ->find($idUser);
        $portefeuilleUser = $user->getPortefeuille();
        $operation = new Operation();
        $operation->setLibele($this->getDesignation());
        $operation->setRef('vente');
        $operation->setMontant($qty);
        $portefeuilleUser->addOperation($operation);
        $em->persist($portefeuilleUser);
        $em->persist($operation);
        $em->flush();
    }
}
