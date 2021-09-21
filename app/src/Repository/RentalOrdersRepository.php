<?php

namespace App\Repository;

use App\Entity\RentalOrders;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RentalOrders|null find($id, $lockMode = null, $lockVersion = null)
 * @method RentalOrders|null findOneBy(array $criteria, array $orderBy = null)
 * @method RentalOrders[]    findAll()
 * @method RentalOrders[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RentalOrdersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RentalOrders::class);
    }

    // /**
    //  * @return RentalOrders[] Returns an array of RentalOrders objects
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
    public function findOneBySomeField($value): ?RentalOrders
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
