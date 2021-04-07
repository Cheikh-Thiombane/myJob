<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OffreEntrepriseController extends AbstractController
{
    #[Route('/offre/entreprise', name: 'offre_entreprise')]
    public function index(): Response
    {
        return $this->render('offre_entreprise/index.html.twig', [
            'controller_name' => 'OffreEntrepriseController',
        ]);
    }
}
