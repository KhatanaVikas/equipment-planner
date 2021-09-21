<?php

namespace App\Repository;

use App\Entity\Equipments;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use DateTime;

/**
 * @method Equipments|null find($id, $lockMode = null, $lockVersion = null)
 * @method Equipments|null findOneBy(array $criteria, array $orderBy = null)
 * @method Equipments[]    findAll()
 * @method Equipments[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EquipmentsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Equipments::class);
    }

    /**
     * @return Equipments[] Returns an array of Equipments objects
     */
    public function findByEquipmentsInStationForDate(int $stationId, string $bookingDate): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = '
            SELECT eq.*, st.name as station_name FROM equipments eq JOIN stations st 
            ON eq.station_id_id = st.id where eq.id NOT IN 
            (SELECT e.id FROM equipments e 
            LEFT join rental_order_equipments roe
            ON e.id = roe.equipment_id_id
            WHERE :booking_date BETWEEN roe.equipment_pickup_date
            AND roe.equipment_drop_date) AND eq.station_id_id = :station_id ORDER BY eq.id
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'booking_date' => $bookingDate,
            'station_id' => $stationId
        ]);

        return $stmt->fetchAllAssociative();
    }
}