<?php

namespace App\Repository;

use App\Entity\Campervans;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Campervans|null find($id, $lockMode = null, $lockVersion = null)
 * @method Campervans|null findOneBy(array $criteria, array $orderBy = null)
 * @method Campervans[]    findAll()
 * @method Campervans[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CampervansRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Campervans::class);
    }

    // /**
    //  * @return Campervans[] Returns an array of Campervans objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Campervans
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
