<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use DateTime;
use App\Entity\Equipments;
use App\Entity\Stations;

class AppController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction(Request $request): Response
    {
        $stations = $this->getDoctrine()
                        ->getRepository(Stations::class)
                        ->findStationsMap();
        
        $defaultData = [];
        $form = $this->createFormBuilder($defaultData)
            ->add('booking_date', DateType::class, [
                'widget' => 'single_text',
                'data' => new \DateTime(),
            ])
            ->add('station', ChoiceType::class, [
                'choices'  => $stations,
            ])
            ->add('send', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $stationId = $data['station'];
            $bookingDate = $data['booking_date'];

            return $this->redirectToRoute(
                'equipment_listing',
                [
                    'stationId'=> $stationId,
                    'bookingDate'=> $bookingDate->getTimestamp()
                ]
            );
        }

        return $this->render('home.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/listing/{stationId}/{bookingDate}", name="equipment_listing")
     */
    public function equipmentListingAction(int $stationId, int $bookingDate): Response
    {
        $date = date('Y-m-d',$bookingDate);
        $result = $this->getDoctrine()
            ->getRepository(Equipments::class)
            ->findByEquipmentsInStationForDate($stationId, $date);
        
        return $this->render('listing.html.twig',['equipments' => $result]);
    }

}