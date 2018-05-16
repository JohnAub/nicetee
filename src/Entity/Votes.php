<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VotesRepository")
 */
class Votes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Dessin", inversedBy="votes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dessin;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $id_user;




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
     * @return int
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @param int $id_user
     */
    public function setIdUser(int $id_user)
    {
        $this->id_user = $id_user;
    }
}

