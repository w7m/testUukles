<?php

namespace App\Controller;

use App\Entity\Material;
use App\Form\MaterialType;
use App\Repository\MaterialRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MaterialController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/add-material', name: 'add_material')]
    public function postMaterial(Request $request): Response
    {
        $material = new Material();
        $material->setCreatedAt(new \DateTimeImmutable('now'));
        $form = $this->createForm(MaterialType::class, $material);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $material = $form->getData();
            $this->entityManager->persist($material);
            $this->entityManager->flush();
            $this->addFlash('success', 'Enregistrement effectué avec succès');
            return $this->redirectToRoute('material_list');
        }

        return $this->render('material-client/new_material.html.twig', [
            'form' => $form->createView(),
            'title' => 'Ajouter un nouveau matériel'
        ]);
    }

    #[Route('/add-material/{id}', name: 'edit_material')]
    public function editMaterial(Material $material, Request $request): Response
    {
        $form = $this->createForm(MaterialType::class, $material);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();
            $this->addFlash('success', 'Modification effectuée avec succès');
            return $this->redirectToRoute('material_list');
        }
        return $this->render('material-client/new_material.html.twig', [
            'form' => $form->createView(),
            'title' => 'Modifier le matériel'
        ]);
    }

    #[Route('/delete-material/{id}', name: 'delete_material')]
    public function deleteClient(Material $material): Response
    {
        $this->entityManager->remove($material);
        $this->entityManager->flush();
        $this->addFlash('success', 'Suppression effectuée avec succès');
        return $this->redirectToRoute('material_list');
    }

    #[Route('/list-material', name: 'material_list')]
    public function materialList(MaterialRepository $materialRepository): Response
    {
        return $this->render('material-client/material_list.html.twig',[
            'materials' => $materialRepository->findAll()
        ]);
    }

}