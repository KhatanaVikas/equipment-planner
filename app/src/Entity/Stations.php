<?php

namespace App\Entity;

use App\Repository\StationsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StationsRepository::class)
 */
class Stations
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Equipments::class, mappedBy="station_id", cascade={"persist", "remove"})
     */
    private $equipments;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEquipments(): ?Equipments
    {
        return $this->equipments;
    }

    public function setEquipments(?Equipments $equipments): self
    {
        // unset the owning side of the relation if necessary
        if ($equipments === null && $this->equipments !== null) {
            $this->equipments->setStationId(null);
        }

        // set the owning side of the relation if necessary
        if ($equipments !== null && $equipments->getStationId() !== $this) {
            $equipments->setStationId($this);
        }

        $this->equipments = $equipments;

        return $this;
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
}
