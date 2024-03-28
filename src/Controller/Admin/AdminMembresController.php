<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\MembreType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class AdminMembresController extends AbstractController
{
    #[Route('/admin/membre', name: 'lesMembresAdmin')]
    public function index(UserRepository $lesMembres): Response
    {
        $lesMembres = $lesMembres->findAll();
        return $this->render('admin/admin_membres/index.html.twig', [
            'membres' => $lesMembres,
        ]);
    }

    #[Route('/admin/ajouterMembre', name: 'admin_membre_ajout')]
    #[Route('/admin/modifierMembre/{id}', name: 'admin_membre_modification')]
    public function AjoutEtModif(User $membre=null, Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $passwordHasher): Response
    {
        if(!$membre){
            $membre = new User();
        }
        $form = $this->createForm(MembreType::class, $membre);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $password=$passwordHasher->hashPassword($membre, $membre->getPassword());
            $membre->setPassword($password);
            $manager->persist($membre);
            $manager->flush();
            return $this->redirectToRoute("lesMembresAdmin");
        } 
        return $this->render('admin/admin_membres/page-modif-ajout.html.twig', [
            'membre' => $membre,
            'form' => $form->createView(), 
            "isModification" => $membre->getId()!==null
            
        ]);
    }

    #[Route('/admin/supprimerType/{id}', name: 'admin_membre_suppression', methods:"delete")]
    public function suppression(User $membre=null, Request $request, EntityManagerInterface $manager): Response
    {
        if($this->isCsrfTokenValid("sup".$membre->getId(), $request->get('_token'))){
            $manager->remove($membre);
            $manager->flush();
            $this->addFlash("success", "Suppression effectuée");
             
        }
        else{
            $this->addFlash("failed", "Suppression non effectuée");
        }
        return $this->redirectToRoute("lesMembresAdmin");      
    }

}
