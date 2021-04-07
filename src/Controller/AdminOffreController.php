<?php

namespace App\Controller;

use App\Form\OffreType;
use App\Entity\OffreEmploi;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\OffreEmploiRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminOffreController extends AbstractController
{
    #[Route('/admin/offres', name: 'admin_offres_index')]
    public function index(OffreEmploiRepository $repoO): Response
    {
        return $this->render('admin/offre/index.html.twig', [
            'offres' => $repoO->findAll(),
        ]);
    }
    #[Route('/admin/offres/{id}/edit', name: 'admin_offres_edit')]
    public function edit(OffreEmploi $offre,Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(OffreType::class, $offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $manager->persist($offre);
            $manager->flush();

            $this->addFlash('success',
            "L'annonce <strong>{$offre->getPoste()}</strong> a bien été enregistrée !!");

        }
        return $this->render('admin/offre/edit.html.twig', [
            'offre' => $offre,
            'form' => $form->createView(),
        ]);
    }
}
