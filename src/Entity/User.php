<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 *     fields = {"email"},
 *     message = "l'email que vous avez indiqué est existe déja !"
 * )
 */
class User implements UserInterface,\Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="8",minMessage="Votre mot de passe doit etre au minimum 8 caractères")
     */
    private $password;

    /**
     * @ORM\Column(type="date")
     *
     */
    private $birthdate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex("/^[0-9]{4}$/")
     */
    private $zipcode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $country;

    /**
     *  @ORM\Column(type="string", length=255)
     * @Assert\Regex("/^[0-9]{8}$/")
     */
    private $phone;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creationtimestamp;

    /**
     * @ORM\Column(type="datetime")
     */
    private $lastlogintimestamp;

    /**
     * @ORM\Column(type="integer")
     */
    private $admin;


    public function __construct()
    {
        $this->creationtimestamp = new \DateTime();
        $this->lastlogintimestamp = new \DateTime('@'.strtotime('now'));
        $this->admin = 0;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        $this->username = $this->firstname;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getZipcode(): ?int
    {
        return $this->zipcode;
    }

    public function setZipcode(int $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getCreationtimestamp(): ?\DateTimeInterface
    {
        return $this->creationtimestamp;
    }

    public function setCreationtimestamp(\DateTimeInterface $creationtimestamp): self
    {
        $this->creationtimestamp = $creationtimestamp;

        return $this;
    }

    public function getLastlogintimestamp(): ?\DateTimeInterface
    {
        return $this->lastlogintimestamp;
    }

    public function setLastlogintimestamp(\DateTimeInterface $lastlogintimestamp): self
    {
        $this->lastlogintimestamp = $lastlogintimestamp;

        return $this;
    }

    public function getAdmin(): ?int
    {
        return $this->admin;
    }

    public function setAdmin(int $admin): self
    {
        $this->admin = $admin;

        return $this;
    }

    public function getRoles()
    {
        
        return ['ROLE_ADMIN'];
    }

    public function getSalt()
    {
      
        return null;
    }


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $username;


    public function setUsername(string $firstname)
    {
         $this->username = $firstname;
         return $this;
    }
    public function getUsername()
    {
        
        return $this->username ;

    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function serialize()
    {
     
        return serialize(
            [$this->id,
                $this->password,
                $this->email]
        );
    }

    public function unserialize($serialized)
    {
        // TODO: Implement unserialize() method.

        list($this->id,
            $this->password,
            $this->email


            ) = unserialize($serialized, ['allowed_classes' =>false]);
    }


}
