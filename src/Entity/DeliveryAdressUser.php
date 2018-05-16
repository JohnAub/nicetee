<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\DeliveryAdressUserRepository")
 * @ORM\Table(name="deliveryAdressUser")
 */
class DeliveryAdressUser
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="deliveryAdressUsers")
     * @ORM\JoinColumn(nullable=false)     *
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $designation;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $complementAdresse;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $pays;

    /**GETTER SETTER*/

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
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * @param string $designation
     */
    public function setDesignation(string $designation)
    {
        $this->designation = $designation;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom(string $prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return int
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * @param int $tel
     */
    public function setTel(int $tel)
    {
        $this->tel = $tel;
    }

    /**
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse(string $adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return string
     */
    public function getComplementAdresse()
    {
        return $this->complementAdresse;
    }

    /**
     * @param string $complementAdresse
     */
    public function setComplementAdresse(string $complementAdresse)
    {
        $this->complementAdresse = $complementAdresse;
    }

    /**
     * @return int
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * @param int $codePostal
     */
    public function setCodePostal(int $codePostal)
    {
        $this->codePostal = $codePostal;
    }

    /**
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param string $ville
     */
    public function setVille(string $ville)
    {
        $this->ville = $ville;
    }

    /**
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * @param string $pays
     */
    public function setPays(string $pays)
    {
        $this->pays = $pays;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }



}

