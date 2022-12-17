<?php

namespace App\Controller;

use App\Entity\Material;
use App\Form\MaterialClientType;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MaterialClientController extends AbstractController
{
    const CONSTRAINT_MATERIAL = 30 ;

    const CONSTRAINT_PRICE = 3000 ;

    #[Route('/total-sold', name: 'total_sold')]
    public function totalSold(ClientRepository $clientRepository): Response
    {
        return $this->render('material-client/total_sold.html.twig',[
            'totalSold' => $clientRepository->getSold()
        ]);
    }

    #[Route('/client-by-price', name: 'client_by_price')]
    public function restrictClientByMaterial(ClientRepository $clientRepository): Response
    {
        return $this->render('material-client/client_by_price_material.html.twig',[
            'clientByPrice' => $clientRepository->getClientByNbrMaterial(self::CONSTRAINT_MATERIAL,self::CONSTRAINT_PRICE)
        ]);
    }

    #[Route('/add-material-client', name: 'add_material_client')]
    public function postMaterialToClient(Request $request, EntityManagerInterface $manager): Response
    {

        $form = $this->createForm(MaterialClientType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $data['client']->addMaterial($data['material']);
            $manager->flush();
            $this->addFlash('success', 'Enregistrement effectué avec succès');
            return $this->redirectToRoute('app_home');
        }

        return $this->render('material-client/material_client.html.twig', [
            'form' => $form->createView()
        ]);
    }

}