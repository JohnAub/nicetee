<?php


namespace App\Model;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 *@ORM\MappedSuperclass
 */
abstract class Produit
{
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $designation;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $sex;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $taille;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $couleur;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $qty;

    /**
     * @var float
     *
     * @ORM\Column(type="float", nullable=true)
     */
    protected $prixVentes;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $qtyVendu;

    /**
     * @var float
     *
     * @ORM\Column(type="float", nullable=true)
     */
    protected $tva;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     */
    protected $dateAjout;


    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $imageHomme;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $imageFemme;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $imageZoomListe;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $imageZoomItem;




    /**************************Constructeur********************/

    public function __construct()
    {
        $this->dateAjout = new \Datetime();
    }
    ///**
     //* Produit constructor.
     //* @param float $prixVentes
     //*/
   /* protected function __construct($prixVentes)
    {
        $this->tva = 1.20;
        $this->prixVentes = $prixVentes * $this->tva;
        $this->dateAjout = new \DateTime();
    }*/




    /****************************GETTER SETTER************************/
    /**
     * @return \DateTime
     */
    public function getDateAjout()
    {
        return $this->dateAjout;
    }

    /**
     * @param \DateTime $dateajout
     */
    public function setDateAjout(\DateTime $dateajout)
    {
        $this->dateAjout = $dateajout;
    }

    /**
     * @return mixed
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * @param mixed $designation
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;
    }

    /**
     * @return string
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @param string $sex
     */
    public function setSex(string $sex)
    {
        $this->sex = $sex;
    }

    /**
     * @return string
     */
    public function getTaille()
    {
        return $this->taille;
    }

    /**
     * @param string $taille
     */
    public function setTaille(string $taille)
    {
        $this->taille = $taille;
    }

    /**
     * @return string
     */
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * @param string $couleur
     */
    public function setCouleur(string $couleur)
    {
        $this->couleur = $couleur;
    }

    /**
     * @return int
     */
    public function getQty()
    {
        return $this->qty;
    }

    /**
     * @param int $qty
     */
    public function setQty(int $qty)
    {
        $this->qty = $qty;
    }

    /**
     * @return float
     */
    public function getPrixventes()
    {
        return $this->prixVentes;
    }

    /**
     * @param float $prixVentes
     */
    public function setPrixventes(float $prixVentes)
    {
        $this->prixVentes = $prixVentes;
    }

    /**
     * @return int
     */
    public function getQtyVendu()
    {
        return $this->qtyVendu;
    }

    /**
     * @param int $qtyVendu
     */
    public function setQtyVendu(int $qtyVendu)
    {
        $this->qtyVendu = $qtyVendu;
    }

    /**
     * @return float
     */
    public function getTva()
    {
        return $this->tva;
    }

    /**
     * @param float $tva
     */
    public function setTva(float $tva)
    {
        $this->tva = $tva;
    }

    /**
     * @return string
     */
    public function getImageHomme(): string
    {
        return $this->imageHomme;
    }

    /**
     * @param string $imageHomme
     */
    public function setImageHomme(string $imageHomme)
    {
        $this->imageHomme = $imageHomme;
    }

    /**
     * @return string
     */
    public function getImageFemme(): string
    {
        return $this->imageFemme;
    }

    /**
     * @param string $imageFemme
     */
    public function setImageFemme(string $imageFemme)
    {
        $this->imageFemme = $imageFemme;
    }

    /**
     * @return string
     */
    public function getImageZoomListe(): string
    {
        return $this->imageZoomListe;
    }

    /**
     * @param string $imageZoomListe
     */
    public function setImageZoomListe(string $imageZoomListe)
    {
        $this->imageZoomListe = $imageZoomListe;
    }

    /**
     * @return string
     */
    public function getImageZoomItem(): string
    {
        return $this->imageZoomItem;
    }

    /**
     * @param string $imageZoomItem
     */
    public function setImageZoomItem(string $imageZoomItem)
    {
        $this->imageZoomItem = $imageZoomItem;
    }




}