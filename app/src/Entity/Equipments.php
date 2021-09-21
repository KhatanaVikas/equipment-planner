<?php

namespace App\Entity;

use App\Repository\EquipmentsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EquipmentsRepository::class)
 */
class Equipments
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Stations::class, inversedBy="equipments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $station_id;

    /**
     * @ORM\OneToMany(targetEntity=RentalOrderEquipments::class, mappedBy="equipmentId")
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStationId(): ?Stations
    {
        return $this->station_id;
    }

    public function setStationId(?Stations $station_id): self
    {
        $this->station_id = $station_id;

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
            $rentalOrderEquipment->setEquipmentId($this);
        }

        return $this;
    }

    public function removeRentalOrderEquipment(RentalOrderEquipments $rentalOrderEquipment): self
    {
        if ($this->rentalOrderEquipments->removeElement($rentalOrderEquipment)) {
            // set the owning side to null (unless already changed)
            if ($rentalOrderEquipment->getEquipmentId() === $this) {
                $rentalOrderEquipment->setEquipmentId(null);
            }
        }

        return $this;
    }
}
