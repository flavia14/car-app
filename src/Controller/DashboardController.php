<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\ActuatorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Actuator;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function dashboard(EntityManagerInterface $entityManager)
    {
        $ledOn = $entityManager->getRepository(Actuator::class)->findOneBy(['name' => 'LED']);

        return $this->render('dashboard/dashboard.html.twig', [
            'ledOn' => $ledOn->isValue(),
        ]);
    }

    /**
     * @Route("/update-led-state", name="update_led_state", methods={"POST"})
     */
    public function updateLEDState(Request $request, EntityManagerInterface $entityManager)
    {
        $ledOn = $request->request->get('ledOn');

        $actuator = $entityManager->getRepository(Actuator::class)->findOneBy(['name' => 'LED']);
        $actuator->setValue($ledOn);
        $entityManager->flush();

        return $this->json(['success' => true]);
    }

    /**
     * @Route("/update-led-state/{timestamp}", name="update_led_state", methods={"GET"})
     */
    public function updateLEDStateAction($timestamp, ActuatorRepository $actuatorRepository): Response
    {
        $actuator = $actuatorRepository->findOneBy(['timestamp' => $timestamp]);
        if ($actuator) {
            $actuator->setValue(true);
            $actuatorRepository->save($actuator, true);
            return new Response('LED status has been updated.');
        } else {
            return new Response('Error: LED associated with the provided timestamp was not found.');
        }
    }
}
