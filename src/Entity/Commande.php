<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
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
     * @ORM\OneToMany(targetEntity="App\Entity\LigneCommande", mappedBy="commande")
     */
    private $ligneCommandes;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $idSale;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idAdresse;

    /***************Constructeur*****************/
    public function __construct()
    {
        $this->date = new \DateTime();
        $this->ligneCommandes = new ArrayCollection();
        $this->status =  0;
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
        $this->ligneCommandes->removeElement($ligneCommande);;
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

    /**
     * @return bool
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param bool $status
     */
    public function setStatus(bool $status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getIdSale()
    {
        return $this->idSale;
    }

    /**
     * @param string $idSale
     */
    public function setIdSale(string $idSale)
    {
        $this->idSale = $idSale;
    }

    /**
     * @return int
     */
    public function getIdAdresse()
    {
        return $this->idAdresse;
    }

    /**
     * @param int $idAdresse
     */
    public function setIdAdresse(int $idAdresse)
    {
        $this->idAdresse = $idAdresse;
    }

    public function getProducts(){
        $products  = array();
        foreach ($this->ligneCommandes as $ligneCommande){
            if ($ligneCommande->getTypeProduit() == 1){
                $products[] = array(
                    'product' => $ligneCommande->getProduitInterne(),
                    'qty' => $ligneCommande->getQty()
                );
            }else{
                $products[] = array(
                    'product' => $ligneCommande->getProduitMembre(),
                    'qty' => $ligneCommande->getQty()
                );
            }
        }
        return $products;
    }

}

