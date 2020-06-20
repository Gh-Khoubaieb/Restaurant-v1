<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MealRepository")
 */
class Meal
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
    private $Name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Photo;

    /**
     * @ORM\Column(type="text")
     */
    private $Description;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantityinstock;

    /**
     * @ORM\Column(type="float")
     */
    private $buyprice;

    /**
     * @ORM\Column(type="float")
     */
    private $saleprice;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->Photo;
    }

    public function setPhoto(string $Photo): self
    {
        $this->Photo = $Photo;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getQuantityInStock(): ?int
    {
        return $this->quantityinstock;
    }

    public function setQuantityInStock(int $quantityinstock): self
    {
        $this->quantityinstock = $quantityinstock;

        return $this;
    }

    public function getBuyPrice(): ?float
    {
        return $this->buyprice;
    }

    public function setBuyPrice(float $buyprice): self
    {
        $this->buyprice = $buyprice;

        return $this;
    }

    public function getSalePrice(): ?float
    {
        return $this->saleprice;
    }

    public function setSalePrice(float $SalePrice): self
    {
        $this->saleprice = $saleprice;

        return $this;
    }
}
