<?php

namespace App\Controller\Admin;

use App\Entity\Type;
use App\Form\TypeType;
use App\Repository\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class AdminTypeController extends AbstractController
{
    #[Route('/admin/type', name: 'lesTypesAdmin')]
    public function index(typeRepository $lesTypes): Response
    {
        $lesTypes = $lesTypes->findAll();
        return $this->render('admin/admin_type/index.html.twig', [
            'lesTypes' => $lesTypes,
        ]);
    }


    #[Route('/admin/ajouterType', name: 'admin_type_ajout')]
    #[Route('/admin/modifierType/{id}', name: 'admin_type_modification')]
    public function AjoutEtModif(Type $type=null, Request $request, EntityManagerInterface $manager): Response
    {
        if(!$type){
            $type = new Type();
        }
        $form = $this->createForm(TypeType::class, $type);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($type);
            $manager->flush();
            return $this->redirectToRoute("lesTypesAdmin");
        }
        return $this->render('admin/admin_type/page-modif-ajout.html.twig', [
            'type' => $type,
            'form' => $form->createView(), 
            'isModification' => $type->getId()!==null
        ]);
    }

    #[Route('/admin/supprimerType/{id}', name: 'admin_type_suppression', methods:"delete")]
    public function suppression(Type $type=null, Request $request, EntityManagerInterface $manager): Response
    {
        if($this->isCsrfTokenValid("sup".$type->getId(), $request->get('_token'))){
            $manager->remove($type);
            $manager->flush();
            $this->addFlash("success", "Suppression effectuée");
             
        }
        else{
            $this->addFlash("failed", "Suppression non effectuée");
        }
        return $this->redirectToRoute("lesTypesAdmin");      
    }
}
