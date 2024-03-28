<?php

namespace App\Controller\Admin;

use App\Entity\Proprietaires;
use App\Form\ProprioType;
use App\Repository\ProprietairesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;


class AdminProprioController extends AbstractController
{

    
    #[Route('/admin/proprietaires', name: 'lesProprietairesAdmin')]
    public function index(ProprietairesRepository $lesProprio): Response
    {
        $lesProprio = $lesProprio->findAll();
        return $this->render('admin/admin_proprio/adminProprio.html.twig', [
            'lesProprio' => $lesProprio,
        ]);
    }


    #[Route('/admin/proprietaire/ajout', name: 'admin_proprio_ajout')]
    #[Route('/admin/proprietaire/modifier/{id}', name: 'admin_proprio_modification')]
    //, methods: ['GET', 'POST']
    public function ajoutEtModif(Proprietaires $lesProprio = null, Request $request, EntityManagerInterface $manager): Response
    {
        if (!$lesProprio) {
            $lesProprio = new Proprietaires();
        }
        $form = $this->createForm(ProprioType::class, $lesProprio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($lesProprio);
            $manager->flush();
            $this->addFlash('success', 'Action effectué avec succès!');
            return $this->redirectToRoute("lesProprietairesAdmin");
        }

        return $this->render('admin/admin_proprio/modificationProprio.html.twig', [
            'proprio' => $lesProprio,
            'form' => $form->createView(),
            "isModification" => $lesProprio->getId() !== null
        ]);
    }


    #[Route('/admin/proprietaire/supprimer/{id}', name: 'admin_proprio_suppression', methods:"delete")]
    public function suppression(Proprietaires $proprio=null, Request $request, EntityManagerInterface $manager): Response
    {
        if($this->isCsrfTokenValid("SUP".$proprio->getId(), $request->get('_token'))){
            $manager->remove($proprio);
            $manager->flush();
            $this->addFlash("success", "Suppression effectuée");
        }
        else{
            $this->addFlash("failed", "Suppression non effectuée");
        }
        return $this->redirectToRoute("lesProprietairesAdmin");      
    }
}
