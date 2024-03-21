<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminBienController extends AbstractController
{
    #[Route('/admin/admin/bien', name: 'app_admin_admin_bien')]
    public function index(): Response
    {
        return $this->render('admin/admin_bien/index.html.twig', [
            'controller_name' => 'AdminBienController',
        ]);
    }
}
