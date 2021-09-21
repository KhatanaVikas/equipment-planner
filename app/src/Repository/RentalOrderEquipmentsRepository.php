<?php

namespace App\Repository;

use App\Entity\RentalOrderEquipments;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RentalOrderEquipments|null find($id, $lockMode = null, $lockVersion = null)
 * @method RentalOrderEquipments|null findOneBy(array $criteria, array $orderBy = null)
 * @method RentalOrderEquipments[]    findAll()
 * @method RentalOrderEquipments[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RentalOrderEquipmentsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RentalOrderEquipments::class);
    }

    // /**
    //  * @return RentalOrderEquipments[] Returns an array of RentalOrderEquipments objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RentalOrderEquipments
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
