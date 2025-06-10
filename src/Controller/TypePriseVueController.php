<?php

namespace App\Controller;

use App\Entity\TypePriseVue;
use App\Form\TypePriseVueForm;
use App\Repository\TypePriseVueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/type/prise/vue')]
final class TypePriseVueController extends AbstractController
{
    #[Route(name: 'app_type_prise_vue_index', methods: ['GET'])]
    public function index(TypePriseVueRepository $typePriseVueRepository): Response
    {
        return $this->render('type_prise_vue/index.html.twig', [
            'type_prise_vues' => $typePriseVueRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_type_prise_vue_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $typePriseVue = new TypePriseVue();
        $form = $this->createForm(TypePriseVueForm::class, $typePriseVue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($typePriseVue);
            $entityManager->flush();

            return $this->redirectToRoute('app_type_prise_vue_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('type_prise_vue/new.html.twig', [
            'type_prise_vue' => $typePriseVue,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_prise_vue_show', methods: ['GET'])]
    public function show(TypePriseVue $typePriseVue): Response
    {
        return $this->render('type_prise_vue/show.html.twig', [
            'type_prise_vue' => $typePriseVue,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_type_prise_vue_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TypePriseVue $typePriseVue, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TypePriseVueForm::class, $typePriseVue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_type_prise_vue_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('type_prise_vue/edit.html.twig', [
            'type_prise_vue' => $typePriseVue,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_prise_vue_delete', methods: ['POST'])]
    public function delete(Request $request, TypePriseVue $typePriseVue, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typePriseVue->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($typePriseVue);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_type_prise_vue_index', [], Response::HTTP_SEE_OTHER);
    }
}
