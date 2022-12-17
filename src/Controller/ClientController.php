<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/add-client', name: 'add_client')]
    public function postClient(Request $request): Response
    {
        $client = new Client();
        $client->setCreatedAt(new \DateTimeImmutable('now'));
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $client = $form->getData();
            $this->entityManager->persist($client);
            $this->entityManager->flush();
            $this->addFlash('success', 'Enregistrement effectué avec succès');
            return $this->redirectToRoute('client_list');
        }

        return $this->render('material-client/new_client.html.twig', [
            'form' => $form->createView(),
            'title' => 'Ajouter un nouveau client'
        ]);
    }

    #[Route('/edit-client/{id}', name: 'edit_client')]
    public function editClient(Client $client, Request $request): Response
    {
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();
            $this->addFlash('success', 'Modification effectuée avec succès');
            return $this->redirectToRoute('client_list');
        }

        return $this->render('material-client/new_client.html.twig', [
            'form' => $form->createView(),
            'title' => 'Modifier le client'
        ]);
    }

    #[Route('/delete-client/{id}', name: 'delete_client')]
    public function deleteClient(Client $client): Response
    {
        $this->entityManager->remove($client);
        $this->entityManager->flush();
        $this->addFlash('success', 'Suppression effectuée avec succès');
        return $this->redirectToRoute('client_list');
    }

    #[Route('/list-client', name: 'client_list')]
    public function clientList(ClientRepository $clientRepository): Response
    {
        return $this->render('material-client/client_list.hmtl.twig' , [
            'clients' => $clientRepository->findAll()
        ]);
    }
}