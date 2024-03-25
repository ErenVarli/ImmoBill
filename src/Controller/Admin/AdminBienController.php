<?php

namespace App\Controller\Admin;

use App\Entity\Bien;
use App\Form\BienType;
use App\Repository\BienRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

class AdminBienController extends AbstractController
{
    #[Route('/admin/bien', name: 'lesBiensAdmin')]
    public function index(BienRepository $lesBiens): Response
    {
        $lesBiens = $lesBiens->findAll();
        return $this->render('admin/admin_bien/index.html.twig', [
            'lesBiens' => $lesBiens,
        ]);
    }

    #[Route('/admin/ajouter', name: 'admin_bien_ajout')]
    #[Route('/admin/modifier/{id}', name: 'admin_bien_modification')]
    public function AjoutEtModif(Bien $bien=null, Request $request, EntityManagerInterface $manager): Response
    {
        if(!$bien){
            $bien = new Bien();
        }
        $form = $this->createForm(BienType::class, $bien);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($bien);
            $manager->flush();
            return $this->redirectToRoute("lesBiensAdmin");
        }
        return $this->render('admin/admin_bien/page-modif-ajout.html.twig', [
            'leBien' => $bien,
            'form' => $form->createView(), 
        "isModification" => $bien->getId()!==null]);
    }

    #[Route('/admin/supprimer/{id}', name: 'admin_bien_suppression', methods:"delete")]
    public function suppression(Bien $bien=null, Request $request, EntityManagerInterface $manager): Response
    {
        if($this->isCsrfTokenValid("sup".$bien->getId(), $request->get('_token'))){
            $manager->remove($bien);
            $manager->flush();
            $this->addFlash("success", "Suppression effectuée");
             
        }
        else{
            $this->addFlash("failed", "Suppression non effectuée");
        }
        return $this->redirectToRoute("lesBiensAdmin");      
    }
}
