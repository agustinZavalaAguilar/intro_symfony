<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Gadget;
use App\Repository\GadgetRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GadgetController extends AbstractController
{
    #[Route('/gadget', name: 'app_gadget')]
    public function index(GadgetRepository $gadgetRepository): Response
    {
        return $this->render('gadget/index.html.twig', [
            'gadgets' => $gadgetRepository->findAll(),
        ]);
    }

    #[Route('/gadget/{id}', name: 'app_gadget_detail')]
    public function detail(Gadget $gadget): Response
    {
        return $this->render('gadget/detail.html.twig', [
            'gadgets' => $gadget,
        ]);
    }
}
