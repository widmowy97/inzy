<?php


namespace App\Controller;

use App\Entity\Visit;
use App\Form\ReservationVisitForm;
use App\Repository\ShowVisitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Routing\Annotation\Route;

class ReservationVisitController extends AbstractController
{
    /**
     * @Route("/reservation-visit", name="app_reservation")
     * @return Response
     */
    public function ReservationVisit(EntityManagerInterface $entityManager, Request $request):Response
    {
        $this->denyAccessUnlessGranted('ROLE_PATIENT');

        $visit = new Visit();
        $ReservationV =$this->createForm(ReservationVisitForm::class, $visit);
        $ReservationV->handleRequest($request);
        if ($ReservationV->isSubmitted() && $ReservationV->isValid()){
            $entityManager->persist($visit);
            $visit->setPatient($this->getUser());
            $EndDate=clone $visit->getStartDate();
            $visit->setEndDate($EndDate->add(new\DateInterval('PT1H')));

            $entityManager->flush();

            return $this->redirectToRoute('app_showvisit');
        }
        return $this->render('visit/reservationvisit.html.twig', ['ReservationV' =>$ReservationV->createView()]);
    }

    /**
     * @Route("/show-visit", name="app_showvisit")
     * @param ShowVisitRepository $showVisitRepository
     * @return Response
     */
    public function showVisit(ShowVisitRepository $showVisitRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $visits = $showVisitRepository->findByPatient($this->getUser());

        return $this->render('visit/showvisit.html.twig', ['visits' => $visits]);
    }
}