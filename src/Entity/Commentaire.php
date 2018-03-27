<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentaireRepository")
 * @ORM\Table(name="commentaire")
 */
class Commentaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Dessin", inversedBy="commentaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dessin;

    /**
     *@var string
     *
     *@ORM\Column(type="string", length=255)
     */
    private $auteur;

    /**
     * @ORM\Column(type="datetime")
     *
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $commentaire;

    /**Constructeur*/
    public function __construct()
    {
        $this->date = new \DateTime();
    }


    /********GETTER-SETTER*********/
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
    public function getDessin()
    {
        return $this->dessin;
    }

    /**
     * @param mixed $dessin
     */
    public function setDessin($dessin)
    {
        $this->dessin = $dessin;
    }

    /**
     * @return mixed
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * @param mixed $auteur
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
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
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * @param string $commentaire
     */
    public function setCommentaire(string $commentaire)
    {
        $this->commentaire = $commentaire;
    }



}
