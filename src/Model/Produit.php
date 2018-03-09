<?php


namespace App\Model;
use Doctrine\ORM\Mapping as ORM;


/**
 *
 *@ORM\MappedSuperclass
 */
abstract class Produit
{
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $designation;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $sex;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $taille;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $couleur;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    protected $qty;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    protected $prixVentes;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    protected $qtyVendu;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    protected $tva;

    /**
     * @ORM\Column(type="datetime")
     *
     */
    protected $dateAjout;





    /**************************Constructeur********************/

    /**
     * Produit constructor.
     * @param float $prixVentes
     */
    protected function __construct($prixVentes)
    {
        $this->tva = 1.20;
        $this->prixVentes = $prixVentes * $this->tva;
        $this->dateAjout = new \DateTime();
    }




    /****************************GETTER SETTER************************/
    /**
     * @return \DateTime
     */
    public function getDateAjout(): \DateTime
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
    public function getSex(): string
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
    public function getTaille(): string
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
    public function getCouleur(): string
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
    public function getQty(): int
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
    public function getPrixventes(): float
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
    public function getQtyVendu(): int
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
    public function getTva(): float
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


}