<?php

namespace App\Controller;

use App\Entity\Candidat;
use App\Repository\CvRepository;
use App\Repository\UserRepository;
use App\Repository\CandidatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CandidatController extends AbstractController
{
    #[Route('/candidat', name: 'candidat')]
    public function index(CandidatRepository $repoC, UserRepository $repoU, CvRepository $repoCv): Response
    {
        $cvs = $repoCv->findAll();
        $users = $repoU->findAll();
        $candidats = $repoC->findAll();

        return $this->render('candidat/index.html.twig', [
            'controller_name' => 'CandidatController',
            'candidats' => $candidats,
            'ville' => '',
            'pays' => '',
            'users' => $users,
        ]);
    }


    #[Route('/candidat/{slug}', name: 'candidat_show')]
    public function showCandidat(Candidat $candidat,Request $request, EntityManagerInterface $manager)
    {
        $user = $candidat->getUser();

        return $this->render('candidat/show.html.twig', [
            'candidat' => $candidat,
            'ville' => '',
            'pays' => '',
            'user' => $user,
        ]);
    }
}
