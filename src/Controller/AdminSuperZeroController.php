<?php

namespace App\Controller;

use App\Entity\SuperZero;
use App\Form\SuperZeroType;
use App\Repository\SuperZeroRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/super/zero')]
class AdminSuperZeroController extends AbstractController
{
    #[Route('/', name: 'app_admin_super_zero_index', methods: ['GET'])]
    public function index(SuperZeroRepository $superZeroRepository): Response
    {
        return $this->render('admin_super_zero/index.html.twig', [
            'super_zeros' => $superZeroRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_super_zero_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $superZero = new SuperZero();
        $form = $this->createForm(SuperZeroType::class, $superZero);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($superZero);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_super_zero_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_super_zero/new.html.twig', [
            'super_zero' => $superZero,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_super_zero_show', methods: ['GET'])]
    public function show(SuperZero $superZero): Response
    {
        return $this->render('admin_super_zero/show.html.twig', [
            'super_zero' => $superZero,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_super_zero_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SuperZero $superZero, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SuperZeroType::class, $superZero);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_super_zero_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_super_zero/edit.html.twig', [
            'super_zero' => $superZero,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_super_zero_delete', methods: ['POST'])]
    public function delete(Request $request, SuperZero $superZero, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$superZero->getId(), $request->request->get('_token'))) {
            $entityManager->remove($superZero);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_super_zero_index', [], Response::HTTP_SEE_OTHER);
    }
}
