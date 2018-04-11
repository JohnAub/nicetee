<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


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
    private $nom;

    /**
     * @var string
     *
     * @Orm\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     */
    private $username;


    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sex;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
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
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $pays;


    /**
     * @var string $email
     *
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @Assert\Length(max=4096)
     * sert juste temporairement à l'inscription
     */
    private $plainPassword;

    /**
     * @var array
     *
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Dessin", mappedBy="user",  orphanRemoval=true)
     */
    private $dessins;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DeliveryAdressUser", mappedBy="user")
     */
    private $deliveryAdressUsers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commande", mappedBy="user")
     */
    private $commandes;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Portefeuille", mappedBy="user")
     */
    private $portefeuille;

    /**
     * @ORM\Column(type="datetime")
     *
     */
    private $dateInscription;

    /****************Constructeur*******************/

    public function __construct()
    {
        $this->dateInscription = new \DateTime();
        $this->roles = 'ROLE_USER';
        $this->dessins = new ArrayCollection();
        $this->deliveryAdressUsers = new ArrayCollection();
        $this->commandes = new ArrayCollection();
    }

    /**
     ***************Getters - Setters***************
     */


    /**
     * @return int
     */
    public function getId()
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
     * @return string
     */
    public function getUsername()
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
     * @return int
     */
    public function getPhoneNumber()
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
     * @param string $Ville
     */
    public function setVille(string $Ville)
    {
        $this->ville = $Ville;
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
     * @return string
     */
    public function getEmail()
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
    public function getPassword()
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
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * @return mixed
     */
    public function getDateInscription()
    {
        return $this->dateInscription;
    }

    /**
     * @param mixed $dateInscription
     */
    public function setDateInscription($dateInscription)
    {
        $this->dateInscription = $dateInscription;
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

    public function addDeliveryAdressUser(DeliveryAdressUser $deliveryAdressUser)
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
     * @return mixed
     */
    public function getCommandes()
    {
        return $this->commandes;
    }


    public function addCommandes(Commande $commande)
    {
        $this->commandes[] = $commande;
        $commande->setUser($this);
        return $this;
    }

    public function removeCommande(Commande $commande){
        $this->commandes->removeElement($commande);
    }


    /**
     * Salt pour cryptage des mots de passe fournis par -> Security component
     * vu que j'utilise bcrypt je n'en ai pas besoin du coup on renvoi null
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

    public function getCompletAdress(){
        $adresse = new DeliveryAdressUser();
        $adresse->setId(0);
        $adresse->setAdresse($this->getAdresse());
        $adresse->setCodePostal($this->getCodePostal());
        $adresse->setVille($this->getVille());
        $adresse->setPays($this->getPays());
        $adresse->setNom($this->getNom());
        $adresse->setPrenom($this->getPrenom());
        $adresse->setTel($this->getPhoneNumber());
        return $adresse;
    }

    /**
     * Removes sensitive data from the user.
     *
     * {@inheritdoc}
     */
    public function eraseCredentials(): void
    {
        //Supprime les données sensibles de l'utilisateur.
        //Ceci est important si, à un moment donné, des informations sensibles comme le mot de passe en texte clair sont stockées sur cet objet.
        //
        $this->plainPassword = null;
    }

    /**
     * @see \Serializable::serialize()
     *
     */
    public function serialize()
    {
        // Génère une représentation stockable d'une valeur
        // pratique pour stocker ou passer des valeurs PHP entre scripts, sans perdre leur structure ni leur type.
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            ));
    }

    /**
     * @see \Serializable::unserialize()
     *
     */
    public function unserialize($serialized): void
    {
        list(
            $this->id,
            $this->username,
            $this->password,
            )= unserialize($serialized);
    }

    /**
     * Retourne les rôles de l'user
     */
    public function getRoles()
    {
        $roles = $this->roles;
        return array($roles);
    }

    public function setRoles(array $roles)
    {
        $this->roles = $roles;
    }
}
