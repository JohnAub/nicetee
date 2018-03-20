<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommandeRepository")
 */
class Commande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="commandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="datetime")
     *
     */
    private $date;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commande", mappedBy="commande")
     */
    private $ligneCommandes;

    /***************Constructeur*****************/
    public function __construct()
    {
        $this->date = new \DateTime();
        $this->ligneCommandes = new ArrayCollection();
    }


    /***************Getter-Setter*****************/
    /**
     * @return mixed
     */
    public function getLigneCommandes()
    {
        return $this->ligneCommandes;
    }


    public function addLigneCommande(LigneCommande $ligneCommande)
    {
        $this->ligneCommandes[] = $ligneCommande;
        $ligneCommande->setCommande($this);
        return $this;
    }

    public function removeLigneCommande(LigneCommande $ligneCommande){
        $this->ligneCommandes->removeElement($ligneCommande);
        //todo effacer lignecommande à vérifier $ligneCommande->setCommande(null);
        $ligneCommande->setCommande(null);
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
    public function setDate(\DateTime $date)
    {
        $this->date = $date;
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

}
