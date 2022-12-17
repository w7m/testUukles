<?php

namespace App\Controller;

use App\Repository\MaterialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function home(MaterialRepository $materialRepository): Response
    {
        return $this->render('home.html.twig',[
            'materials' => $materialRepository->findAll()
        ]);
    }
}