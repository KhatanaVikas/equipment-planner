<?php

namespace App\Entity;

use App\Repository\CampervansRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CampervansRepository::class)
 */
class Campervans
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=RentalOrders::class, mappedBy="campervan_id")
     */
    private $rentalOrders;

    public function __construct()
    {
        $this->rentalOrders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|RentalOrders[]
     */
    public function getRentalOrders(): Collection
    {
        return $this->rentalOrders;
    }

    public function addRentalOrder(RentalOrders $rentalOrder): self
    {
        if (!$this->rentalOrders->contains($rentalOrder)) {
            $this->rentalOrders[] = $rentalOrder;
            $rentalOrder->setCampervanId($this);
        }

        return $this;
    }

    public function removeRentalOrder(RentalOrders $rentalOrder): self
    {
        if ($this->rentalOrders->removeElement($rentalOrder)) {
            // set the owning side to null (unless already changed)
            if ($rentalOrder->getCampervanId() === $this) {
                $rentalOrder->setCampervanId(null);
            }
        }

        return $this;
    }
}
