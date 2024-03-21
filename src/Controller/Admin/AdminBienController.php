<?php

namespace App\Controller\Admin;

use App\Repository\BienRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminBienController extends AbstractController
{
    #[Route('/admin/bien', name: 'lesBiensAdmin')]
    public function index(BienRepository $lesBiens): Response
    {
        $lesBiens->findAll();
        return $this->render('admin/admin_bien/index.html.twig', [
            'lesBiens' => $lesBiens,
        ]);
    }
}
