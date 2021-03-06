<?php

namespace App\Repository;

use App\Entity\Stations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Stations|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stations|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stations[]    findAll()
 * @method Stations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StationsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stations::class);
    }

    public function findStationsMap(): array
    {
        $stations = $this->findAll();
        $formInputStations = [];
        foreach ($stations as $station) {
            $formInputStations[$station->getName()] = $station->getId();
        }

        return $formInputStations;
    }
}
