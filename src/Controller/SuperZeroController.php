<?php

namespace App\Controller;

use App\Repository\SuperZeroRepository;
use App\Entity\SuperZero;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SuperZeroController extends AbstractController
{
    #[Route('/super/zero', name: 'app_super_zero')]
    public function index(SuperZeroRepository $superZeroRepository): Response
    {
        $superZeros = $superZeroRepository->findAll();

        return $this->render('super_zero/index.html.twig', [
            'superZeros' => $superZeros,
        ]);
    }

    #[Route('/super/zero/{id}', name: 'app_super_zero_detail')]
    public function detail(SuperZero $superZero): Response
    {       
        return $this->render('super_zero/detail.html.twig',[
            'superZero' => $superZero,
        ]);
            
    }
}
