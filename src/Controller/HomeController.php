<?php

namespace App\Controller;

use App\Entity\Cv;
use App\Entity\User;
use App\Form\CvType;
use App\Entity\Candidat;
use App\Entity\Entreprise;
use App\Entity\OffreEmploi;
use App\Repository\UserRepository;
use App\Repository\CandidatRepository;
use App\Repository\CvRepository;
use App\Repository\EntrepriseRepository;
use App\Repository\MetierRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\OffreEmploiRepository;
use App\Repository\RegionRepository;
use App\Repository\SecteurActiviteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(SecteurActiviteRepository $repoSec, RegionRepository $repoReg, MetierRepository $repoM,EntrepriseRepository $repoE, CandidatRepository $repoC, OffreEmploiRepository $repoO, UserRepository $repoU): Response
    {
        $users = $repoU->findAll();
        $offres = $repoO->findAll();
        $candidats = $repoC->findAll();
        $entreprises = $repoE->findAll();

        $user = new User();

        /* foreach ($entreprises as $entreprise) {
            $entreprise = $repoE->findOneBy($entreprises);
            if ($entreprise->getUser()==$user) {
                $userEntreprise = $entreprise->getUser();
            }
        } */
        $candidat = new Candidat();
        $candidat_tab =[];
        foreach ($candidats as $key => $candidat) {
            if (!is_null($candidat->getCv()->getFormations())) {
              array_push($candidat_tab , $candidat);
            }
        }



        $userEntreprise = new User;//$repoO->findOneByEntreprise($entreprise);




        $entreprises_length = count($entreprises);
        $candidats_length = count($candidats);
        $offres_length = count($offres);
        if ($this->getUser() !== null && $this->getUser()->getEntreprise() !== NULL) {
            return $this->redirectToRoute('entreprise_account');
        }else {
            # code...
            return $this->render('home/index.html.twig', [
                'controller_name' => 'HomeController',
                'picture' => '',
                'pays' => '',
                'entreprises' => $entreprises,
                'users' => $users,
                //'entreprises_length' => $entreprises,
            'candidats' => $candidat_tab,
            'offres' => $offres,
            'secteur_activite' => $repoSec->findAll(),
            'metiers' => $repoM->findAll(),
            'regions' => $repoReg->findAll(),
            ]);
        }
    }



    #[Route('/entreprise/{slug}', name: 'entreprise_show')]
    public function showEntreprise(Entreprise $entreprise)
    {
        $user = new User();
        $user = $entreprise->getUser();
        // $obb = $repo->findOneBySlug($slug);

        return $this->render('entreprise/show.html.twig', [
            'entreprise' => $entreprise,
            'ville' => '',
            'pays' => '',
            'user' => $user,
        ]);
    }


}
