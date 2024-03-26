<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminGlobalController extends AbstractController
{
    #[Route('/admin', name: 'app_admin_bienvenue')]
    public function index(): Response
    {
        return $this->render('admin/admin_global/adminAccueil.html.twig', [
            'name' => 'Admin'
        ]);
    }
}
