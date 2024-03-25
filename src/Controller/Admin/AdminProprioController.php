<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminProprioController extends AbstractController
{
    #[Route('/admin/proprio', name: 'app_admin_proprio')]
    public function index(): Response
    {
        return $this->render('admin_proprio/adminProprio.html.twig', [
            'controller_name' => 'AdminProprioController',
        ]);
    }
}
