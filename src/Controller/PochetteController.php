<?php

namespace App\Controller;

use App\Entity\Pochette;
use App\Form\PochetteForm;
use App\Repository\PochetteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/pochette')]
final class PochetteController extends AbstractController
{
    #[Route(name: 'app_pochette_index', methods: ['GET'])]
    public function index(PochetteRepository $pochetteRepository): Response
    {
        return $this->render('pochette/index.html.twig', [
            'pochettes' => $pochetteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_pochette_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $pochette = new Pochette();
        $form = $this->createForm(PochetteForm::class, $pochette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($pochette);
            $entityManager->flush();

            return $this->redirectToRoute('app_pochette_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pochette/new.html.twig', [
            'pochette' => $pochette,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_pochette_show', methods: ['GET'])]
    public function show(Pochette $pochette): Response
    {
        return $this->render('pochette/show.html.twig', [
            'pochette' => $pochette,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_pochette_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Pochette $pochette, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PochetteForm::class, $pochette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_pochette_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pochette/edit.html.twig', [
            'pochette' => $pochette,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_pochette_delete', methods: ['POST'])]
    public function delete(Request $request, Pochette $pochette, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pochette->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($pochette);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_pochette_index', [], Response::HTTP_SEE_OTHER);
    }
}
