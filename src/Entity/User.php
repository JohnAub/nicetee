<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="user")
 */
class User implements UserInterface, \Serializable
{
    //@var sert a php Documentor
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
     * @Orm\Column(type="string", length=255)
     */
    private $fullName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $pseudo;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $sex;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $phoneNumber;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", length=255)
     */
    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $Ville;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $pays;


    /**
     * @var string
     *
     * @ORM\column(type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Dessin", mappedBy="user")
     */
    private $dessins;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DeliveryAdressUser", mappedBy="user")
     */
    private $deliveryAdressUsers;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Portefeuille", mappedBy="user")
     */
    private $portefeuille;

    /****************Constructeur*******************/

    public function __construct()
    {
        $this->dessins = new ArrayCollection();
        $this->deliveryAdressUsers = new ArrayCollection();
    }

    /**
     ***************Getters - Setters***************
     */


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @param string $fullName
     */
    public function setFullName(string $fullName)
    {
        $this->fullName = $fullName;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    /**
     * @param string $pseudo
     */
    public function setPseudo(string $pseudo)
    {
        $this->pseudo = $pseudo;
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
     * @return int
     */
    public function getPhoneNumber(): int
    {
        return $this->phoneNumber;
    }

    /**
     * @param int $phoneNumber
     */
    public function setPhoneNumber(int $phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return string
     */
    public function getAdresse(): string
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
     * @return int
     */
    public function getCodePostal(): int
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
    public function getVille(): string
    {
        return $this->Ville;
    }

    /**
     * @param string $Ville
     */
    public function setVille(string $Ville)
    {
        $this->Ville = $Ville;
    }

    /**
     * @return string
     */
    public function getPays(): string
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
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getDessins()
    {
        return $this->dessins;
    }


    public function addDessin(Dessin $dessin)
    {
        $this->dessins[] = $dessin;
        $dessin->setUser($this);
        return $this;
    }

    public function removeDessin(Dessin $dessin){
        $this->dessins->removeElement($dessin);
    }

    /**
     * @return mixed
     */
    public function getDeliveryAdressUsers()
    {
        return $this->deliveryAdressUsers;
    }

    public function addDeliveryAdressUser(Dessin $deliveryAdressUser)
    {
        $this->deliveryAdressUsers[] = $deliveryAdressUser;
        $deliveryAdressUser->setUser($this);
        return $this;
    }


    public function removeDeliveryAdressUser(DeliveryAdressUser $deliveryAdressUser)
    {
        $this->deliveryAdressUsers->removeElement($deliveryAdressUser);
    }


    public function getPortefeuille()
    {
        return $this->portefeuille;
    }

    /**
     * @param mixed $portefeuille
     */
    public function setPortefeuille($portefeuille)
    {
        $this->portefeuille = $portefeuille;
    }



    /**
     * Salt pour cryptage des mots de passe fournis par -> Security component
     *
     * {@inheritdoc}
     */
    public function getSalt(): ?string
    {
        /**
         *
         */
        return null;
    }

    /**
     * Removes sensitive data from the user.
     *
     * {@inheritdoc}
     */
    public function eraseCredentials(): void
    {
        // Nous n'avons pas besoin de cette methode car nous n'utilions pas de plainPassword
        // Mais elle est obligatoire car comprise dans l'interface UserInterface
        // $this->plainPassword = null;
    }

    /**
     * {@inheritdoc}
     */
    public function serialize(): string
    {
        // Génère une représentation stockable d'une valeur
        // pratique pour stocker ou passer des valeurs PHP entre scripts, sans perdre leur structure ni leur type.
        return serialize([$this->id, $this->username, $this->password]);
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($serialized): void
    {
        [$this->id, $this->username, $this->password] = unserialize($serialized, ['allowed_classes' => false]);
    }

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        // TODO: Implement getRoles() method.
    }
}
