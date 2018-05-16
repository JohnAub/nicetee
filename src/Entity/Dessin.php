<?php


namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbrVotes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Votes", mappedBy="dessin")
     */
    private $votes;


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

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Image", cascade={"persist", "remove"})
     * @Assert\NotNull()
     */
    protected $imageDessin;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Image", cascade={"persist", "remove"})
     * @Assert\NotNull()
     */
    protected $imageDessinMiniature;

    /**Constructeur*/
    public function __construct()
    {
        $this->date = new \DateTime();
        $this->commentaires = new ArrayCollection();
        $this->votes =  new ArrayCollection();
    }

    /****************************GETTER SETTER************************/

    /**
     * @return integer
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
    public function getNbrVotes()
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
     * @return mixed
     */
    public function getVotes()
    {
        return $this->votes;
    }

    public function addVotes(Votes $vote)
    {
        $this->votes[] = $vote;
        $vote->setDessin($this);
        return $this;
    }

    public function removeVote(Votes $vote){
        $this->votes->removeElement($vote);
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
    public function getResume()
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

    public function addCommentaire(Commentaire $commentaire)
    {
        $this->commentaires[] = $commentaire;
        $commentaire->setDessin($this);
        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire){
        $this->commentaires->removeElement($commentaire);
    }

    /**
     * @return mixed
     */
    public function getImageDessin()
    {
        return $this->imageDessin;
    }


    public function setImageDessin(Image $imageDessin)
    {
        $this->imageDessin = $imageDessin;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getImageDessinMiniature()
    {
        return $this->imageDessinMiniature;
    }


    public function setImageDessinMiniature(Image $imageDessinMiniature)
    {
        $this->imageDessinMiniature = $imageDessinMiniature;
        return $this;
    }

    public function getImageDessinAdmin(){
        $image = $this->getImageDessinMiniature();
        $url = $image->getWebPath();
        return $url;
    }
    public function CountCom(){
        return count($this->getCommentaires());
    }
}
