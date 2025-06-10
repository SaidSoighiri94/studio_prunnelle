<?php

namespace App\Controller;

use App\Entity\TypeVente;
use App\Form\TypeVenteForm;
use App\Repository\TypeVenteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/type/vente')]
final class TypeVenteController extends AbstractController
{
    #[Route(name: 'app_type_vente_index', methods: ['GET'])]
    public function index(TypeVenteRepository $typeVenteRepository): Response
    {
        return $this->render('type_vente/index.html.twig', [
            'type_ventes' => $typeVenteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_type_vente_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $typeVente = new TypeVente();
        $form = $this->createForm(TypeVenteForm::class, $typeVente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($typeVente);
            $entityManager->flush();

            return $this->redirectToRoute('app_type_vente_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('type_vente/new.html.twig', [
            'type_vente' => $typeVente,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_vente_show', methods: ['GET'])]
    public function show(TypeVente $typeVente): Response
    {
        return $this->render('type_vente/show.html.twig', [
            'type_vente' => $typeVente,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_type_vente_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TypeVente $typeVente, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TypeVenteForm::class, $typeVente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_type_vente_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('type_vente/edit.html.twig', [
            'type_vente' => $typeVente,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_vente_delete', methods: ['POST'])]
    public function delete(Request $request, TypeVente $typeVente, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeVente->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($typeVente);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_type_vente_index', [], Response::HTTP_SEE_OTHER);
    }
}
