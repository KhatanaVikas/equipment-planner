<?php

namespace App\Entity;

use App\Repository\RentalOrderEquipmentsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RentalOrderEquipmentsRepository::class)
 */
class RentalOrderEquipments
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=RentalOrders::class, inversedBy="rentalOrderEquipments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $orderId;

    /**
     * @ORM\ManyToOne(targetEntity=Equipments::class, inversedBy="rentalOrderEquipments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $equipmentId;

    /**
     * @ORM\Column(type="date")
     */
    private $equipmentPickupDate;

    /**
     * @ORM\Column(type="date")
     */
    private $equipmentDropDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderId(): ?RentalOrders
    {
        return $this->orderId;
    }

    public function setOrderId(?RentalOrders $orderId): self
    {
        $this->orderId = $orderId;

        return $this;
    }

    public function getEquipmentId(): ?Equipments
    {
        return $this->equipmentId;
    }

    public function setEquipmentId(?Equipments $equipmentId): self
    {
        $this->equipmentId = $equipmentId;

        return $this;
    }

    public function getEquipmentPickupDate(): ?\DateTimeInterface
    {
        return $this->equipmentPickupDate;
    }

    public function setEquipmentPickupDate(\DateTimeInterface $equipmentPickupDate): self
    {
        $this->equipmentPickupDate = $equipmentPickupDate;

        return $this;
    }

    public function getEquipmentDropDate(): ?\DateTimeInterface
    {
        return $this->equipmentDropDate;
    }

    public function setEquipmentDropDate(\DateTimeInterface $equipmentDropDate): self
    {
        $this->equipmentDropDate = $equipmentDropDate;

        return $this;
    }
}
