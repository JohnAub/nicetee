<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PortefeuilleRepository")
 */
class Portefeuille
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    private $solde;

    /**
     * @ORM\Column(type="datetime")
     *
     */
    private $date;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="portefeuille")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Operation", mappedBy="portefeuille")
     */
    private $operations;


    /****************Constructeur******************/
    public function __construct()
    {
        $this->date = new \DateTime();
        $this->operations = new ArrayCollection();
        $this->solde = 0;
    }


    /**************GETTER-SETTER************///
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getSolde(): float
    {
        return $this->solde;
    }

    /**
     * @param float $solde
     */
    public function setSolde(float $solde)
    {
        $this->solde = $solde;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }


    /**
     * @return mixed
     */
    public function getOperations()
    {
        return $this->operations;
    }

    public function addOperation(Operation $operation)
    {
        $this->operations[] = $operation;
        $operation->setPortefeuille($this);
        $this->setSolde($operation->getMontant());
        return $this;
    }
}

