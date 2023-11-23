<?php

namespace App\Controller;

use App\Entity\Matiere;
use App\Form\MatiereFormAddType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class MatiereController extends AbstractController
{
    #[Route('/matieres', name: 'app_matieres')]
    public function index(EntityManagerInterface $em, Request $request): Response
    {
        $matieres = $em->getRepository(Matiere::class)->findAll();
        $matiere = new Matiere();
        $form = $this->createForm(MatiereFormAddType::class, $matiere);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($matiere);
            $em->flush();
            return $this->redirectToRoute('app_matieres');
        }

        return $this->render('matiere/index.html.twig', [
            'controller_name' => 'MatiereController',
            'matieres' => $matieres,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/matiere/{id}', name: 'matiere_show')]
    public function edit(Request $request, Matiere $matiere, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(MatiereFormAddType::class, $matiere);
        $formView = $form->createView();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', 'modifications reussie');
            $em->persist($matiere);
            $em->flush();
        }

        return $this->render('matiere/show.html.twig', [
            'matiere' => $matiere,
            'form' => $formView,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/matiere/{id}/delete', name: 'matiere_delete')]
    public function delete(Matiere $matiere, EntityManagerInterface $em): Response
    {
        $em->remove($matiere);
        $em->flush();
        $this->addFlash('success', 'Catégorie supprimée avec succès.');

        return $this->redirectToRoute('app_matieres');

    }


}
