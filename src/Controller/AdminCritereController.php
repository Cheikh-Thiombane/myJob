<?php

namespace App\Controller;

use App\Entity\Langue;
use App\Entity\Metier;
use App\Entity\Region;
use App\Form\LangueType;
use App\Form\MetierType;
use App\Form\RegionType;
use App\Form\ContratType;
use App\Form\NiveauEType;
use App\Entity\NiveauEtude;
use App\Entity\TypeContrat;
use App\Entity\SecteurActivite;
use App\Entity\NiveauExperience;
use App\Form\SecteurActiviteType;
use App\Form\NiveauExperienceType;
use App\Repository\LangueRepository;
use App\Repository\MetierRepository;
use App\Repository\RegionRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\NiveauEtudeRepository;
use App\Repository\TypeContratRepository;
use App\Repository\SecteurActiviteRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\NiveauExperienceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminCritereController extends AbstractController
{
    #[Route('/admin/criteres', name: 'admin_criteres_index')]
    public function index(Request $request, EntityManagerInterface $manager,SecteurActiviteRepository $repoSec, MetierRepository $repoM, RegionRepository $repoR,
     TypeContratRepository $repoT, LangueRepository $repoL,NiveauEtudeRepository $repoNe, NiveauExperienceRepository $repoNex): Response
    {
        $secteur = new SecteurActivite();
        $formSec = $this->createForm(SecteurActiviteType::class, $secteur);

        $formSec->handleRequest($request);
        if ($formSec->isSubmitted() && $formSec->isValid()){
            $manager->persist($secteur);
            $manager->flush();

            return $this->redirectToRoute('admin_criteres_index');
        }
        $metier = new Metier();
        $formM = $this->createForm(MetierType::class, $metier);

        $formM->handleRequest($request);
        if ($formM->isSubmitted() && $formM->isValid()){
            $manager->persist($metier);
            $manager->flush();

            return $this->redirectToRoute('admin_criteres_index');
        }
        $region = new Region();
        $formR = $this->createForm(RegionType::class, $region);

        $formR->handleRequest($request);
        if ($formR->isSubmitted() && $formR->isValid()){
            $manager->persist($region);
            $manager->flush();

            return $this->redirectToRoute('admin_criteres_index');
        }
        $contrat = new TypeContrat();
        $formC = $this->createForm(ContratType::class, $contrat);

        $formC->handleRequest($request);
        if ($formC->isSubmitted() && $formC->isValid()){
            $manager->persist($contrat);
            $manager->flush();

            return $this->redirectToRoute('admin_criteres_index');
        }
        $langue = new Langue();
        $formL = $this->createForm(LangueType::class, $langue);

        $formL->handleRequest($request);
        if ($formL->isSubmitted() && $formL->isValid()){
            $langue->setNiveau(100);
            $manager->persist($langue);
            $manager->flush();

            return $this->redirectToRoute('admin_criteres_index');
        }
        $experience = new NiveauExperience();
        $formEx = $this->createForm(NiveauExperienceType::class, $experience);

        $formEx->handleRequest($request);
        if ($formEx->isSubmitted() && $formEx->isValid()){
            $manager->persist($experience);
            $manager->flush();

            return $this->redirectToRoute('admin_criteres_index');
        }
        $etude = new NiveauEtude();
        $formE = $this->createForm(NiveauEType::class, $etude);

        $formE->handleRequest($request);
        if ($formE->isSubmitted() && $formE->isValid()){
            $manager->persist($etude);
            $manager->flush();

            return $this->redirectToRoute('admin_criteres_index');
        }

        return $this->render('admin/critere/index.html.twig', [
            'formSec' => $formSec->createView(),
            'formEx' => $formEx->createView(),
            'formE' => $formE->createView(),
            'formC' => $formC->createView(),
            'formL' => $formL->createView(),
            'formM' => $formM->createView(),
            'formR' => $formR->createView(),
            'secteurs' => $repoSec->findAll(),
            'metiers' => $repoM->findAll(),
            'regions' => $repoR->findAll(),
            'typeContrats' => $repoT->findAll(),
            'langues' => $repoL->findAll(),
            'experiences' => $repoNex->findAll(),
            'etudes' => $repoNe->findAll(),

        ]);
    }
    private $entity;
    public function edit($entity){
        $this->entity = $entity;
        
    }

    #[Route('/admin/secteur/{id}/delete', name: 'admin_secteur_delete')]
    public function deletesecteur(SecteurActivite $secteur, EntityManagerInterface $manager): Response
    {
        $manager->remove($secteur);
        $manager->flush();
        return $this->redirectToRoute('admin_criteres_index');
    }

    #[Route('/admin/secteur/{id}/edit', name: 'admin_secteur_edit')]
    public function editsecteur(SecteurActivite $secteur, Request $request, EntityManagerInterface $manager,SecteurActiviteRepository $repoSec, MetierRepository $repoM, RegionRepository $repoR,
    TypeContratRepository $repoT, LangueRepository $repoL,NiveauEtudeRepository $repoNe, NiveauExperienceRepository $repoNex): Response
    {

        $formSec = $this->createForm(SecteurActiviteType::class, $secteur);

        $formSec->handleRequest($request);
        if ($formSec->isSubmitted() && $formSec->isValid()){
            $manager->persist($secteur);
            $manager->flush();

            return $this->redirectToRoute('admin_criteres_index');
        }
        $metier = new Metier();
        $formM = $this->createForm(MetierType::class, $metier);

        $formM->handleRequest($request);
        if ($formM->isSubmitted() && $formM->isValid()){
            $manager->persist($metier);
            $manager->flush();

            return $this->redirectToRoute('admin_criteres_index');
        }
        $region = new Region();
        $formR = $this->createForm(RegionType::class, $region);

        $formR->handleRequest($request);
        if ($formR->isSubmitted() && $formR->isValid()){
            $manager->persist($region);
            $manager->flush();

            return $this->redirectToRoute('admin_criteres_index');
        }
        $contrat = new TypeContrat();
        $formC = $this->createForm(ContratType::class, $contrat);

        $formC->handleRequest($request);
        if ($formC->isSubmitted() && $formC->isValid()){
            $manager->persist($contrat);
            $manager->flush();

            return $this->redirectToRoute('admin_criteres_index');
        }
        $langue = new Langue();
        $formL = $this->createForm(LangueType::class, $langue);

        $formL->handleRequest($request);
        if ($formL->isSubmitted() && $formL->isValid()){
            $langue->setNiveau(100);
            $manager->persist($langue);
            $manager->flush();

            return $this->redirectToRoute('admin_criteres_index');
        }
        $experience = new NiveauExperience();
        $formEx = $this->createForm(NiveauExperienceType::class, $experience);

        $formEx->handleRequest($request);
        if ($formEx->isSubmitted() && $formEx->isValid()){
            $manager->persist($experience);
            $manager->flush();

            return $this->redirectToRoute('admin_criteres_index');
        }
        $etude = new NiveauEtude();
        $formE = $this->createForm(NiveauEType::class, $etude);

        $formE->handleRequest($request);
        if ($formE->isSubmitted() && $formE->isValid()){
            $manager->persist($etude);
            $manager->flush();

            return $this->redirectToRoute('admin_criteres_index');
        }

        return $this->render('admin/critere/index.html.twig', [
            'formSec' => $formSec->createView(),
            'formEx' => $formEx->createView(),
            'formE' => $formE->createView(),
            'formC' => $formC->createView(),
            'formL' => $formL->createView(),
            'formM' => $formM->createView(),
            'formR' => $formR->createView(),
            'secteurs' => $repoSec->findAll(),
            'metiers' => $repoM->findAll(),
            'regions' => $repoR->findAll(),
            'typeContrats' => $repoT->findAll(),
            'langues' => $repoL->findAll(),
            'experiences' => $repoNex->findAll(),
            'etudes' => $repoNe->findAll(),
            'secteur' => $secteur,
            'modify' => true
        ]);
    }

    #[Route('/admin/metier/{id}/delete', name: 'admin_metier_delete')]
    public function deletemetier( Metier $metier, EntityManagerInterface $manager): Response
    {
        $manager->remove($metier);
        $manager->flush();
        return $this->redirectToRoute('admin_criteres_index');
    }
    #[Route('/admin/region/{id}/delete', name: 'admin_region_delete')]
    public function deleteregion( Region $region, EntityManagerInterface $manager): Response
    {
        $manager->remove($region);
        $manager->flush();
        return $this->redirectToRoute('admin_criteres_index');
    }
    #[Route('/admin/contrat/{id}/delete', name: 'admin_contrat_delete')]
    public function deletecontrat(TypeContrat $contrat, EntityManagerInterface $manager): Response
    {
        $manager->remove($contrat);
        $manager->flush();
        return $this->redirectToRoute('admin_criteres_index');
    }
    #[Route('/admin/langue/{id}/delete', name: 'admin_langue_delete')]
    public function deletelangue( Langue $langue, EntityManagerInterface $manager): Response
    {
        $manager->remove($langue);
        $manager->flush();
        return $this->redirectToRoute('admin_criteres_index');
    }
    #[Route('/admin/etude/{id}/delete', name: 'admin_etude_delete')]
    public function deleteetude(NiveauEtude $etude, EntityManagerInterface $manager): Response
    {
        $manager->remove($etude);
        $manager->flush();
        return $this->redirectToRoute('admin_criteres_index');
    }
    #[Route('/admin/experience/{id}/delete', name: 'admin_experience_delete')]
    public function deleteexperience(NiveauExperience $experience, EntityManagerInterface $manager): Response
    {
        $manager->remove($experience);
        $manager->flush();
        return $this->redirectToRoute('admin_criteres_index');
    }
}
