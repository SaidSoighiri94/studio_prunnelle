<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Form\AdresseForm;
use App\Repository\AdresseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/adresse')]
final class AdresseController extends AbstractController
{
    #[Route(name: 'app_adresse_index', methods: ['GET'])]
    public function index(AdresseRepository $adresseRepository): Response
    {
        return $this->render('adresse/index.html.twig', [
            'adresses' => $adresseRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_adresse_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $adresse = new Adresse();
        $form = $this->createForm(AdresseForm::class, $adresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($adresse);
            $entityManager->flush();

            return $this->redirectToRoute('app_adresse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('adresse/new.html.twig', [
            'adresse' => $adresse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_adresse_show', methods: ['GET'])]
    public function show(Adresse $adresse): Response
    {
        return $this->render('adresse/show.html.twig', [
            'adresse' => $adresse,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_adresse_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Adresse $adresse, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AdresseForm::class, $adresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_adresse_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('adresse/edit.html.twig', [
            'adresse' => $adresse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_adresse_delete', methods: ['POST'])]
    public function delete(Request $request, Adresse $adresse, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adresse->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($adresse);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_adresse_index', [], Response::HTTP_SEE_OTHER);
    }
}
