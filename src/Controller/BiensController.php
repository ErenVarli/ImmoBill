<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\BienRepository;

class BiensController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }

    #[Route('/biens', name: 'biens')]
    public function biens(BienRepository $bienRepository ): Response
    {
        $bien = $bienRepository->findAll();
        return $this->render('biens/biens.html.twig',[
            'biens'=>$bien
        ]
    );
    }

    #[Route('/biens/{id}', name: 'detailBien')]
    public function afficherBiens($id,BienRepository $bienRepository ): Response
    {
        $bien = $bienRepository->find($id);
        return $this->render('biens/afficherbien.html.twig',[
            'bien'=>$bien
        ]
    );
    }
}
