<?php

namespace App\Entity;

use App\Repository\WorkorderPartRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=WorkorderPartRepository::class)
 */
class WorkorderPart
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Workorder::class, inversedBy="workorderParts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $workorder;

    /**
     * @ORM\ManyToOne(targetEntity=Part::class, inversedBy="workorderParts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $part;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWorkorder(): ?Workorder
    {
        return $this->workorder;
    }

    public function setWorkorder(?Workorder $workorder): self
    {
        $this->workorder = $workorder;

        return $this;
    }

    public function getPart(): ?Part
    {
        return $this->part;
    }

    public function setPart(?Part $part): self
    {
        $this->part = $part;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }
}
