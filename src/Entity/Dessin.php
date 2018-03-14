<?php


namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DessinRepository")
 * @ORM\Table(name="dessin")
 */


class Dessin
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
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="dessins")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="datetime")
     *
     */
    private $date;


    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $nbrVotes;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $designation;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $resume;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commentaire", mappedBy="dessin")
     */
    private $commentaires;




    /**Constructeur*/
    public function __construct()
    {
        $this->date = new \DateTime();
        $this->commentaires = new ArrayCollection();
    }



    /****************************GETTER SETTER************************/

    /**
     * @return integer
     */
    public function getId(): int
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
    public function setUser( User $user)
    {
        $this->user = $user;
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
    public function getNbrVotes(): string
    {
        return $this->nbrVotes;
    }

    /**
     * @param string $nbrVotes
     */
    public function setNbrVotes(string $nbrVotes)
    {
        $this->nbrVotes = $nbrVotes;
    }

    /**
     * @return string
     */
    public function getDesignation(): string
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
    public function getResume(): string
    {
        return $this->resume;
    }

    /**
     * @param string $resume
     */
    public function setResume(string $resume)
    {
        $this->resume = $resume;
    }


    /**
     * @return mixed
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    public function adCommentaire(Commentaire $commentaire)
    {
        $this->commentaires[] = $commentaire;
        $commentaire->setDessin($this);
        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire){
        $this->commentaires->removeElement($commentaire);
    }



}