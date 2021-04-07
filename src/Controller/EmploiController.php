<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Entreprise;
use App\Entity\OffreEmploi;
use App\Repository\LangueRepository;
use App\Repository\MetierRepository;
use App\Repository\RegionRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\NiveauEtudeRepository;
use App\Repository\OffreEmploiRepository;
use App\Repository\TypeContratRepository;
use Knp\Component\Pager\PaginatorInterface;
use App\Repository\SecteurActiviteRepository;
use App\Repository\NiveauExperienceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class EmploiController extends AbstractController
{

    #[Route('/emploi', name: 'emploi')]
    public function emploi(PaginatorInterface $paginator,OffreEmploiRepository $repoO, SecteurActiviteRepository $repoSec, MetierRepository $repoM, RegionRepository $repoR,
    TypeContratRepository $repoT, LangueRepository $repoL,NiveauEtudeRepository $repoNe, NiveauExperienceRepository $repoNex, Request $request )
    {
        
        $offreEmplois = $repoO->findAll();

        $offreEmploisP = $paginator->paginate(
            $offreEmplois, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            10 // Nombre de résultats par page
        );

        return $this->render('emploi/index.html.twig', [
            'offre_emplois' => $offreEmplois,
            'offre_emploisP' => $offreEmploisP,
            'secteur_activites' => $repoSec->findAll(),
            'metiers' => $repoM->findAll(),
            'regions' => $repoR->findAll(),
            'type_contrats' => $repoT->findAll(),
            'langues' => $repoL->findAll(),
            'experiences' => $repoNex->findAll(),
            'etudes' => $repoNe->findAll(),
        ]);
    }

    #[Route('/emploi/{slug}', name: 'emploi_show')]
    public function show(OffreEmploi $emploi)
    {
        $entreprise = $emploi->getEntreprise();

        // $obb = $repo->findOneBySlug($slug);

        return $this->render('emploi/show.html.twig', [
            'entreprise' => $entreprise,
            'emploi' => $emploi,
            'ville' => '',
            'pays' => '',

        ]);
    }
    /**
     * ///
     * @Security("is_granted('ROLE_USER')")
     */
    #[Route('/emploi/add/{slug}', name: 'emploi_add')]
    public function addEmploi(OffreEmploi $emploi, EntityManagerInterface $manager)
    {
        $candidat = $this->getUser()->getCandidat();
        $candidat->addOffre($emploi);
        $emploi->addCandidat($candidat);
        $manager->persist($candidat);
        $manager->persist($emploi);
        $manager->flush();
        //$obb = $repo->findOneBySlug($slug);
        return $this->redirectToRoute('my_account');
    }
    /**
     * /
     * @Security("is_granted('ROLE_USER')")
     */
    #[Route('/emploi/remove/{id}', name: 'emploi_remove')]
    public function removeEmploi(OffreEmploi $emploi, EntityManagerInterface $manager)
    {
        $candidat = $this->getUser()->getCandidat();
        $candidat->removeOffre($emploi);
        $emploi->removeCandidat($candidat);
        $manager->persist($candidat);
        $manager->persist($emploi);
        $manager->flush();
        //$obb = $repo->findOneBySlug($slug);
        return $this->redirectToRoute('my_account');
    }
}
