<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\MissionRepository;
use App\Entity\Mission;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MissionController extends AbstractController
{
    #[Route('/mission', name: 'app_mission')]
    public function index(MissionRepository $missionRepository): Response
    {
        $missions = $missionRepository->findAll();

        return $this->render('mission/index.html.twig', [
            'missions' => $missions,
        ]);
    }

    #[Route('/mission/{id}', name: 'app_mission_detail')]
    public function detail(Mission $mission ): Response
    {
        return $this->render('mission/detail.html.twig', [
            'mission' => $mission,
        ]);
    }
}
