<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $UserId;

    /**
     * @ORM\Column(type="float")
     */
    private $Totalamount;

    /**
     * @ORM\Column(type="integer")
     */
    private $Taxrate;

    /**
     * @ORM\Column(type="float")
     */
    private $taxamount;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creationtimestamp;

    /**
     * @ORM\Column(type="datetime")
     */
    private $completetimestamp;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->UserId;
    }

    public function setUserId(int $UserId): self
    {
        $this->UserId = $UserId;

        return $this;
    }

    public function getTotalamount(): ?float
    {
        return $this->Totalamount;
    }

    public function setTotalamount(float $Totalamount): self
    {
        $this->Totalamount = $Totalamount;

        return $this;
    }

    public function getTaxrate(): ?int
    {
        return $this->Taxrate;
    }

    public function setTaxrate(int $Taxrate): self
    {
        $this->Taxrate = $Taxrate;

        return $this;
    }

    public function getTaxamount(): ?float
    {
        return $this->taxamount;
    }

    public function setTaxamount(float $taxamount): self
    {
        $this->taxamount = $taxamount;

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

    public function getCompletetimestamp(): ?\DateTimeInterface
    {
        return $this->completetimestamp;
    }

    public function setCompletetimestamp(\DateTimeInterface $completetimestamp): self
    {
        $this->completetimestamp = $completetimestamp;

        return $this;
    }
    public function __construct()
    {
        $this->creationtimestamp = new \DateTime();
        $this->completentimestamp = new  \DateTime();
    }
}
