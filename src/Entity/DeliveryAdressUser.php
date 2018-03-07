<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DeliveryAdressUserRepository")
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
     * @var string
     *
     * @ORM\Column(type="string", unique=true)
     */
    private $adresseName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", unique=true)
     */
    private $adresse;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", unique=true)
     */
    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(type="string", unique=true)
     */
    private $Ville;

    /**
     * @var string
     *
     * @ORM\Column(type="string", unique=true)
     */
    private $pays;

}
