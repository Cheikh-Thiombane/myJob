<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Entreprise;
use App\Form\EntrepriseType;
use App\Form\EditEntrepriseType;
use App\Repository\UserRepository;
use App\Repository\EntrepriseRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\NiveauEtudeRepository;
use App\Repository\SecteurActiviteRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\NiveauExperienceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EntrepriseController extends AbstractController
{



    #[Route('/entreprise', name: 'entreprise')]
    public function index(EntrepriseRepository $repoE, UserRepository $repoU): Response
    {
        $entreprises = $repoE->findAll();
        $users = $repoU->findAll();
        return $this->render('entreprise/index.html.twig', [
            'controller_name' => 'EntrepriseController',
            'ville' => '',
            'pays' => '',
            'entreprises' => $entreprises,
            'users' => $users,
            'secteur_activite' => [
                'Activités associatives',
                'Administration publique',
                'Aéronautique, navale',
                'Agriculture, pêche, aquaculture',
                'Agroalimentaire',
                'Ameublement, décoration',
                'Automobile, matériels de transport, réparation',
                'Banque, assurance, finances',
                'BTP, construction',
                'Centres d´appel, hotline, call center',
                'Chimie, pétrochimie, matières premières',
                'Conseil, audit, comptabilité',
                'Distribution, vente, commerce de gros',
                'Édition, imprimerie',
                'Éducation, formation',
                'Electricité, eau, gaz, nucléaire, énergie',
                'Environnement, recyclage',
                'Equip. électriques, électroniques, optiques, précision',
                'Equipements mécaniques, machines',
                'Espaces verts, forêts, chasse',
                'Évènementiel, hôte(sse), accueil',
                'Hôtellerie, restauration',
                'Immobilier, architecture, urbanisme',
                'Import, export',
                'Industrie pharmaceutique',
                'Industrie, production, fabrication, autres',
                'Informatique, SSII, Internet',
                'Ingénierie, études développement',
                'Intérim, recrutement',
                'Location',
                'Luxe, cosmétiques',
                'Maintenance, entretien, service après vente',
                'Manutention',
                'Marketing, communication, médias',
                'Métallurgie, sidérurgie',
                'Nettoyage, sécurité, surveillance',
                'Papier, bois, caoutchouc, plastique, verre, tabac',
                'Produits de grande consommation',
                'Qualité, méthodes',
                'Recherche et développement',
                'Santé, pharmacie, hôpitaux, équipements médicaux',
                'Secrétariat',
                'Services aéroportuaires et maritimes',
                'Services autres',
                'Services collectifs et sociaux, services à la personne',
                'Sport, action culturelle et sociale',
                'Télécom',
                'Textile, habillement, cuir, chaussures',
                'Tourisme, loisirs',
                'Transports, logistique, services postaux',
            ],
            'metiers' => [
                'Achats',
                'Commercial, vente',
                'Gestion, comptabilité, finance',
                'Informatique, nouvelles technologies',
                'Juridique',
                'Management, direction générale',
                'Marketing, communication',
                'Métiers de la santé et du social',
                'Métiers des services',
                'Métiers du BTP',
                'Production, maintenance, qualité',
                'R&D, gestion de projets',
                'RH, formation',
                'Secretariat, assistanat',
                'Tourisme, hôtellerie, restauration',
                'Transport, logistique',
            ],
            'regions' => [
                'Dakar',
                'Diourbel',
                'Fatick',
                'Kaffrine',
                'Kaolack',
                'Kédougou',
                'Kolda',
                'Louga',
                'Matam',
                'Saint-Louis',
                'Sédhiou',
                'Tambacounda',
                'Thiès',
                'Ziguinchor',
                'International ',
            ]
        ]);
    }


    #[Route('/entreprise/{slug}', name: 'entreprise_show')]
    public function show(Entreprise $entreprise)
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
    #[Route('/entreprise/view', name: 'entreprise_account')]
    public function my_account(Request $request, EntityManagerInterface $manager)
    {
        $user = $this->getUser();
        $entreprise = $user->getEntreprise();
        // $obb = $repo->findOneBySlug($slug);

        return $this->render('entreprise/showEntreprise.html.twig', [
            'entreprise' => $entreprise,
            'ville' => '',
            'pays' => '',
            'user' => $user,
        ]);
    }

    #[Route('/entreprise/edit', name:'entreprise_edit')]
    public function editEntreprise(SecteurActiviteRepository $repoSec ,Request $request, EntityManagerInterface $manager)
    {
        $secteurActivites = $repoSec->findAll();
        $user = $this->getUser();
        $entreprise = $user->getEntreprise();

        $form = $this->createForm(EditEntrepriseType::class,$user);
        $form2 = $this->createForm(EntrepriseType::class,$entreprise);

        $form->handleRequest($request);
        $form2->handleRequest($request);
        if (isset($_POST['secteur'])) {
            foreach ($_POST['secteur'] as $key => $value) {
                $id = $value;
                $secteurActivite = $repoSec->find($id);
                $entreprise->addSecteurActivite($secteurActivite);
            }
        }
        //$secteurActivite = $request->request->get('')
        //$entreprise->addSecteurActivite($request-)
        if ($form->isSubmitted() && $form->isValid()){
            if ($form2->isSubmitted() && $form2->isValid()){
            //$password = $encoder->encodePassword($user, $user->getHash());
            //$user->setHash($password);
            //$userEntreprise = $this->getUser();
            $entreprise->setUser($user);
            $manager->persist($user);
            $manager->persist($entreprise);

            $manager->flush();

            $this->addFlash(
                'success', "Votre compte a bien été créé ! Vous pouvez maintenant vous connecter !"
            );

            return $this->redirectToRoute('entreprise_account');
            }
        }

        return $this->render('entreprise/edit.html.twig', [
            'form' => $form->createView(),
            'form2' =>$form2->createView(),
            'entreprise' => $entreprise,
            'user' => $user,

        ]);
    }
}
