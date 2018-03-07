<?php


namespace App\Entity;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;
    //TODO Faire le liens dans les 2 cotés

    /**
     * @ORM\Column(type="datetime")
     *
     */
    private $date;


    /**
     * @var string
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
     * @return int
     */


    /**Constructeur*/
    public function __construct()
    {
        $this->date = new \DateTime();
    }



    /****************************GETTER SETTER************************/


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





}