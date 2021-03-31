<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\OffreEmploi;
use App\Repository\OffreEmploiRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EmploiController extends AbstractController
{

    #[Route('/emploi', name: 'emploi')]
    public function emploi(OffreEmploiRepository $repoO)
    {
        $offreEmplois = $repoO->findAll();
        $emplois = [
            'Caisse nationale de crédit agricole du Sénégal (CNCAS)',
            'Chemin de fer du Dakar-Niger',
            'Compagnie bancaire de l\'Afrique occidentale (CBAO)',
            'Consortium d\'emplois (CDE)',
            'Compagnie sucrière sénégalaise (CSS)',
            'Compagnie sénégalaise des phosphates de Taïba (CSPT)',
            'Crédit du Sénégal (CDS) (ex Crédit Lyonnais Sénégal)',
            'Crédit lyonnais Sénégal (CLS)Caisse nationale de crédit agricole du Sénégal (CNCAS)',
            'Chemin de fer du Dakar-Niger',
            'Compagnie bancaire de l\'Afrique occidentale (CBAO)',
            'Consortium d\'emplois (CDE)',
            'Compagnie sucrière sénégalaise (CSS)',
            'Compagnie sénégalaise des phosphates de Taïba (CSPT)',
            'Crédit du Sénégal (CDS) (ex Crédit Lyonnais Sénégal)',
            'Crédit lyonnais Sénégal (CLS)',
            'Senbus Industries',
            'Sénégalaise des eaux (SDE)',
            'Shell Sénégal',
            'Société africaine de raffinage (SAR)',
            'Société des brasseries de l\'Ouest africain (SOBOA)',
            'Société générale de banques au Sénégal (SGBS)',
            'Société nationale des conserveries du Sénégal (SNCDS)',
            'Société nationale d\'électricité du Sénégal (Senelec)',
            'Société nationale des télécommunications (Sonatel-Orange)',
            'Sococim',
            'Le Soleil',
            'Suneor (ex-SONACOS)',
        ];
        $secteur_activites = [
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
        ];
        $metiers = [
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
        ];
        $regions = [
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
        ];
        $typeContrats = [
            'CDD',
            'CDI',
            'Stage',
            'Intérim',
            'Freelance',
            'Temps partiel',
            'Alternance ',
        ];
        $langues = ['Francais','Anglais'];

        return $this->render('emploi/index.html.twig', [
            'secteur_activites' => $secteur_activites,
            'metiers' => $metiers,
            'regions' => $regions,
            'type_contrats' => $typeContrats,
            'offre_emplois' => $offreEmplois
        ]);
    }

    #[Route('/emploi/{slug}', name: 'emploi_show')]
    public function show(OffreEmploi $emploi)
    {

        // $obb = $repo->findOneBySlug($slug);

        return $this->render('emploi/show.html.twig', [
            'emploi' => $emploi,
            'ville' => '',
            'pays' => '',
            
        ]);
    }
}
