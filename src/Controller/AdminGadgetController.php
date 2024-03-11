<?php

namespace App\Controller;

use App\Entity\Gadget;
use App\Form\GadgetType;
use App\Repository\GadgetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/gadget')]
class AdminGadgetController extends AbstractController
{
    #[Route('/', name: 'app_admin_gadget_index', methods: ['GET'])]
    public function index(GadgetRepository $gadgetRepository): Response
    {
        return $this->render('admin_gadget/index.html.twig', [
            'gadgets' => $gadgetRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_gadget_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $gadget = new Gadget();
        $form = $this->createForm(GadgetType::class, $gadget);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($gadget);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_gadget_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_gadget/new.html.twig', [
            'gadget' => $gadget,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_gadget_show', methods: ['GET'])]
    public function show(Gadget $gadget): Response
    {
        return $this->render('admin_gadget/show.html.twig', [
            'gadget' => $gadget,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_gadget_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Gadget $gadget, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GadgetType::class, $gadget);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_gadget_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin_gadget/edit.html.twig', [
            'gadget' => $gadget,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_gadget_delete', methods: ['POST'])]
    public function delete(Request $request, Gadget $gadget, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$gadget->getId(), $request->request->get('_token'))) {
            $entityManager->remove($gadget);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_gadget_index', [], Response::HTTP_SEE_OTHER);
    }
}
