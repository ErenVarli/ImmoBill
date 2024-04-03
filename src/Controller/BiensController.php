<?php

namespace App\Controller;

use App\Entity\BienSearch;
use App\Form\BienSearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\BienRepository;
use Symfony\Component\HttpFoundation\Request;

class BiensController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }
    
    #[Route('/admin', name: 'adminPanel')]
    public function admin_panel(): Response
    {
        return $this->render('admin.html.twig');
    }

    #[Route('/biens', name: 'biens')]
    public function biens(BienRepository $bienRepository, Request $request): Response
    {
        $search = new BienSearch();
        $form = $this->createForm(BienSearchType::class, $search);
        $form->handleRequest($request);
        if($form->getData() != null){
            if($form->isSubmitted() && $form->isValid()){
                $bien = $bienRepository->searchBien($search);
            }
        }
        else{
            $bien = $bienRepository->findAll();
        }
        return $this->render('biens/biens.html.twig',[
            'biens'=>$bien,
            'form' =>$form->createView(),
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
