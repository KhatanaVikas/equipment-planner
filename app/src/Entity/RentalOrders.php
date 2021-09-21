<?php

namespace App\Entity;

use App\Repository\RentalOrdersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RentalOrdersRepository::class)
 */
class RentalOrders
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Campervans::class, inversedBy="rentalOrders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $campervan_id;

    /**
     * @ORM\ManyToOne(targetEntity=Stations::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $startStation;

    /**
     * @ORM\ManyToOne(targetEntity=Stations::class)
     */
    private $EndStation;

    /**
     * @ORM\Column(type="date")
     */
    private $rentalStartDate;

    /**
     * @ORM\Column(type="date")
     */
    private $rentalEndDate;

    /**
     * @ORM\OneToMany(targetEntity=RentalOrderEquipments::class, mappedBy="orderId")
     */
    private $rentalOrderEquipments;

    public function __construct()
    {
        $this->rentalOrderEquipments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCampervanId(): ?Campervans
    {
        return $this->campervan_id;
    }

    public function setCampervanId(?Campervans $campervan_id): self
    {
        $this->campervan_id = $campervan_id;

        return $this;
    }

    public function getStartStation(): ?Stations
    {
        return $this->startStation;
    }

    public function setStartStation(?Stations $startStation): self
    {
        $this->startStation = $startStation;

        return $this;
    }

    public function getEndStation(): ?Stations
    {
        return $this->EndStation;
    }

    public function setEndStation(?Stations $EndStation): self
    {
        $this->EndStation = $EndStation;

        return $this;
    }

    public function getRentalStartDate(): ?\DateTimeInterface
    {
        return $this->rentalStartDate;
    }

    public function setRentalStartDate(\DateTimeInterface $rentalStartDate): self
    {
        $this->rentalStartDate = $rentalStartDate;

        return $this;
    }

    public function getRentalEndDate(): ?\DateTimeInterface
    {
        return $this->rentalEndDate;
    }

    public function setRentalEndDate(\DateTimeInterface $rentalEndDate): self
    {
        $this->rentalEndDate = $rentalEndDate;

        return $this;
    }

    /**
     * @return Collection|RentalOrderEquipments[]
     */
    public function getRentalOrderEquipments(): Collection
    {
        return $this->rentalOrderEquipments;
    }

    public function addRentalOrderEquipment(RentalOrderEquipments $rentalOrderEquipment): self
    {
        if (!$this->rentalOrderEquipments->contains($rentalOrderEquipment)) {
            $this->rentalOrderEquipments[] = $rentalOrderEquipment;
            $rentalOrderEquipment->setOrderId($this);
        }

        return $this;
    }

    public function removeRentalOrderEquipment(RentalOrderEquipments $rentalOrderEquipment): self
    {
        if ($this->rentalOrderEquipments->removeElement($rentalOrderEquipment)) {
            // set the owning side to null (unless already changed)
            if ($rentalOrderEquipment->getOrderId() === $this) {
                $rentalOrderEquipment->setOrderId(null);
            }
        }

        return $this;
    }
}
