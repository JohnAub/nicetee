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
     * @var int
     *
     * @ORM\Column(type="integer")
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
    private $libélé;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $ref;

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
     * @return int
     */
    public function getMontant(): int
    {
        return $this->montant;
    }

    /**
     * @param int $montant
     */
    public function setMontant(int $montant)
    {
        $this->montant = $montant;
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
     * @return string
     */
    public function getLibélé(): string
    {
        return $this->libélé;
    }

    /**
     * @param string $libélé
     */
    public function setLibélé(string $libélé)
    {
        $this->libélé = $libélé;
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
