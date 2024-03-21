<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BiensController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    public function index(): Response
    {
        return $this->render('biens/index.html.twig', [
            'controller_name' => 'BiensController',
        ]);
    }

    #[Route('/biens', name: 'biens')]
    public function biens(): Response
    {
        
        return $this->render('biens/biens.html.twig',[
            
        ]
    );
    }
}
