<?php
namespace App\Controller\v1;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;
use DateInterval;
use App\Entity\Equipments;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends AbstractController
{
    /**
     * @Route("/v1/listing/{stationId}/{bookingDate}", name="equipment_listing_v1")
     */
    public function equipmentListingAction(int $stationId, int $bookingDate)
    {
        $date = date('Y-m-d',$bookingDate);
        $result = $this->getDoctrine()
            ->getRepository(Equipments::class)
            ->findByEquipmentsInStationForDate($stationId, $date);
            
        return new Response(
            json_encode([
                'equipments' => $result,
            ]),
            Response::HTTP_OK,
            ['content-type' => 'application/json']
        );
    }
}