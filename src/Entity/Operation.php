<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OperationRepository")
 */
class Operation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Portefeuille", inversedBy="operations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $portefeuille;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    private $montant;

    /**
     * @ORM\Column(type="datetime")
     *
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $libele;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $ref;


    /***********************Constructeur***********************/
    public function __construct()
    {
        $this->date = new \DateTime();
    }

    /****************************GETTER SETTER************************/
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
    public function getPortefeuille()
    {
        return $this->portefeuille;
    }

    /**
     * @param mixed $portefeuille
     */
    public function setPortefeuille($portefeuille)
    {
        $this->portefeuille = $portefeuille;
    }

    /**
     * @return float
     */
    public function getMontant(): float
    {
        return $this->montant;
    }

    /**
     * @param float $montant
     */
    public function setMontant(float $montant)
    {
        $this->montant = $montant;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
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
     * @return string
     */
    public function getLibele(): string
    {
        return $this->libele;
    }

    /**
     * @param string $libele
     */
    public function setLibele(string $libele)
    {
        $this->libele = $libele;
    }

    /**
     * @return string
     */
    public function getRef(): string
    {
        return $this->ref;
    }

    /**
     * @param string $ref
     */
    public function setRef(string $ref)
    {
        $this->ref = $ref;
    }
}

