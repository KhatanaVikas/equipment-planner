<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Stations;
use App\Entity\Campervans;
use App\Entity\Equipments;
use App\Entity\RentalOrders;
use DateTime;
use DateInterval;
use App\Entity\RentalOrderEquipments;

class AppFixtures extends Fixture
{
    const STATIONS = ['Munich', 'Paris', 'Porto', 'Madrid'];
    const EQUIPMENTS = ['Portable toilet', 'Bed sheet', 'Sleeping bag', 'Camping table', 'Chair'];

    public function load(ObjectManager $manager)
    {
        $this->createStations($manager);
        $this->createCampervans($manager);
        $this->createEquipments($manager);
        $this->createRentalOrders($manager);
        $this->createRentalOrderEquipments($manager);
    }

    private function createStations(ObjectManager $manager): void
    {
        foreach (self::STATIONS as $stationName) {
            $station = new Stations();
            $station->setName($stationName);
            $manager->persist($station);
        }
        $manager->flush();
    }

    private function createCampervans(ObjectManager $manager): void
    {
        for ($i = 0; $i < 4; $i++) {
            $campervan = new Campervans();
            $manager->persist($campervan);
        }
        $manager->flush();
    }

    private function createEquipments(ObjectManager $manager): void
    {
        $stations = $manager->getRepository(Stations::class)->findAll();
        foreach (self::EQUIPMENTS as $equipmentName) {
            foreach ($stations as $key=>$station) {
                $equipment = new Equipments();
                $equipment->setName($equipmentName.' '. ($key+1));
                $equipment->setStationId($station);
                $manager->persist($equipment);
            }
        }

        $manager->flush();
    }

    private function createRentalOrders(ObjectManager $manager): void
    {
        $stations = $manager->getRepository(Stations::class)->findAll();
        $campervans = $manager->getRepository(Campervans::class)->findAll();
        
        $orderDates = $this->getOrderDates();
        $rentalOrder1 = new RentalOrders();
        $rentalOrder1->setCampervanId($campervans[0]);
        $rentalOrder1->setStartStation($stations[0]);
        
        $rentalOrder1->setRentalStartDate($orderDates['date2DaysAhead']);
        $rentalOrder1->setRentalEndDate($orderDates['date4DaysAhead']);

        $rentalOrder2 = new RentalOrders();
        $rentalOrder2->setCampervanId($campervans[1]);
        $rentalOrder2->setStartStation($stations[2]);
        $rentalOrder2->setRentalStartDate($orderDates['date6DaysAhead']);
        $rentalOrder2->setRentalEndDate($orderDates['date8DaysAhead']);
        $manager->persist($rentalOrder1);
        $manager->persist($rentalOrder2);
        $manager->flush();
    }

    private function createRentalOrderEquipments(ObjectManager $manager): void
    {
        $rentalOrders = $manager->getRepository(RentalOrders::class)->findAll();
        $equipments = $manager->getRepository(Equipments::class)->findAll();
        $orderDates = $this->getOrderDates();
        //first equipment for oder 1
        $rentalOrderEquipment1 = new RentalOrderEquipments();
        $rentalOrderEquipment1->setOrderId($rentalOrders[0]);
        $rentalOrderEquipment1->setEquipmentId($equipments[1]);//bedsheet 1
        $rentalOrderEquipment1->setEquipmentPickupDate($orderDates['date2DaysAhead']);
        $rentalOrderEquipment1->setEquipmentDropDate($orderDates['date4DaysAhead']);
        //second equipment for oder 1
        $rentalOrderEquipment2 = new RentalOrderEquipments();
        $rentalOrderEquipment2->setOrderId($rentalOrders[0]);
        $rentalOrderEquipment2->setEquipmentId($equipments[3]);//camping table 1
        $rentalOrderEquipment2->setEquipmentPickupDate($orderDates['date2DaysAhead']);
        $rentalOrderEquipment2->setEquipmentDropDate($orderDates['date4DaysAhead']);

        //first equipment for oder 2
        $rentalOrderEquipment3 = new RentalOrderEquipments();
        $rentalOrderEquipment3->setOrderId($rentalOrders[1]);
        $rentalOrderEquipment3->setEquipmentId($equipments[7]);//sleeping bag 2
        $rentalOrderEquipment3->setEquipmentPickupDate($orderDates['date6DaysAhead']);
        $rentalOrderEquipment3->setEquipmentDropDate($orderDates['date8DaysAhead']);
        //second equipment for oder 2
        $rentalOrderEquipment4 = new RentalOrderEquipments();
        $rentalOrderEquipment4->setOrderId($rentalOrders[1]);
        $rentalOrderEquipment4->setEquipmentId($equipments[9]);//chair 2
        $rentalOrderEquipment4->setEquipmentPickupDate($orderDates['date6DaysAhead']);
        $rentalOrderEquipment4->setEquipmentDropDate($orderDates['date8DaysAhead']);

        $manager->persist($rentalOrderEquipment1);
        $manager->persist($rentalOrderEquipment2);
        $manager->persist($rentalOrderEquipment3);
        $manager->persist($rentalOrderEquipment4);
        $manager->flush();

    }

    private function getOrderDates(): array
    {
        $date2 = new DateTime();
        $date4 = new DateTime();
        $date6 = new DateTime();
        $date8 = new DateTime();

        return [
            'date2DaysAhead' => $date2->add(new DateInterval('P2D')),
            'date4DaysAhead' => $date4->add(new DateInterval('P4D')),
            'date6DaysAhead' => $date6->add(new DateInterval('P6D')),
            'date8DaysAhead' => $date8->add(new DateInterval('P8D')),
        ];
    }
}
