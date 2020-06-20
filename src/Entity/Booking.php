<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookingRepository")
 */
class Booking
{
    public function __construct()
    {
        $this->Creationtimestamp = new \DateTime();
    }

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $Bookingdate;

    /**
     * @ORM\Column(type="time")
     */
    private $Bookingtime;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Regex("/^[1-9]\d*$/")
     */
    private $Numberofseats;

    /**
     * @ORM\Column(type="integer")
     */
    private $User_Id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Creationtimestamp;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBookingdate(): ?\DateTimeInterface
    {
        return $this->Bookingdate;
    }

    public function setBookingdate(\DateTimeInterface $Bookingdate): self
    {
        $this->Bookingdate = $Bookingdate;

        return $this;
    }

    public function getBookingtime(): ?\DateTimeInterface
    {
        return $this->Bookingtime;
    }

    public function setBookingtime(\DateTimeInterface $Bookingtime): self
    {
        $this->Bookingtime = $Bookingtime;

        return $this;
    }

    public function getNumberofseats(): ?int
    {
        return $this->Numberofseats;
    }

    public function setNumberofseats(int $Numberofseats): self
    {
        $this->Numberofseats = $Numberofseats;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->User_Id;
    }

    public function setUserId(int $User_Id): self
    {
        $this->User_Id = $User_Id;

        return $this;
    }

    public function getCreationtimestamp(): ?\DateTimeInterface
    {
        return $this->CreationTimestamp;
    }

    public function setCreationtimestamp(\DateTimeInterface $Creationtimestamp): self
    {
        $this->Creationtimestamp = $Creationtimestamp;

        return $this;
    }
}
