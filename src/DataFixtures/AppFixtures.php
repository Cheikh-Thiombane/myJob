<?php

namespace App\DataFixtures;

use App\Entity\Cv;
use Faker\Factory;
use App\Entity\Role;
use App\Entity\User;
use App\Entity\Langue;
use App\Entity\Metier;
use App\Entity\Region;
use App\Entity\Critere;
use App\Entity\Candidat;
use App\Entity\Formation;
use App\Entity\Entreprise;
use App\Entity\Experience;
use App\Entity\NiveauEtude;
use App\Entity\OffreEmploi;
use App\Entity\TypeContrat;
use App\Entity\SecteurActivite;
use App\Entity\NiveauExperience;
use App\Repository\LangueRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{


    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        //$repolangue = new LangueRepository();
        $faker = Factory::create('fr_FR');
        $faker_1 = Factory::create('en_US');

        //Nous gerons les users
        $users = [];
        $schools = [
            'Institut superieur informatique',
            'Ecole national d\'aviation',
            'Institut Privé de Gestion (IPG)',
            'Ecole des Hautes Etudes de Gestion ( H .E.G)',
            'Institution Sainte Jeanne d’Arc',
            'Institut de Formation et d’Assistance AFI',
            'Institut Supérieur de Management ISM'];
        $entreprises = [
            'Caisse nationale de crédit agricole du Sénégal (CNCAS)',
            'Chemin de fer du Dakar-Niger',
            'Compagnie bancaire de l\'Afrique occidentale (CBAO)',
            'Consortium d\'entreprises (CDE)',
            'Compagnie sucrière sénégalaise (CSS)',
            'Compagnie sénégalaise des phosphates de Taïba (CSPT)',
            'Crédit du Sénégal (CDS) (ex Crédit Lyonnais Sénégal)',
            'Crédit lyonnais Sénégal (CLS)Caisse nationale de crédit agricole du Sénégal (CNCAS)',
            'Chemin de fer du Dakar-Niger',
            'Compagnie bancaire de l\'Afrique occidentale (CBAO)',
            'Consortium d\'entreprises (CDE)',
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
        $secteurActivites = [
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
        $langues = [
            'Arabe',
            'Français',
            'Anglais',
            'Espagnol',
            'Allemand',
            'Italien',
            'Afrikaans',
            'Amharique',
            'Arménien',
            'Azéri',
            'Bengalî',
            'Berbère',
            'Biélorusse',
            'Birman',
            'Bulgare',
            'Catalan',
            'Chinois',
            'Coréen',
            'Croate',
            'Danois',
            'Estonien',
            'Finlandais',
            'Géorgien',
            'Grec',
            'Hébreu',
            'Hindi',
            'Hongrois',
            'Indonésien',
            'Irlandais',
            'Islandais',
            'Japonais',
            'Kazahk',
            'Khmer',
            'Kirghiz',
            'Lao',
            'Letton',
            'Lituanien',
            'Luxembourgeois',
            'Macédonien',
            'Malais',
            'Mongol',
            'Néerlandais',
            'Népali',
            'Norvégien',
            'Ourdou',
            'Ouzbek',
            'Persan',
            'Polonais',
            'Portugais',
            'Roumain',
            'Russe',
            'Serbe',
            'Slovaque',
            'Slovène',
            'Suédois',
            'Tadjik',
            'Tamoul',
            'Tchèque',
            'Thaï',
            'Turc',
            'Turkmène',
            'Ukrainien',
            'Vietnamien',
            'Bosnien',
            'Divehi',
            'Dzongkha ',
        ];
        $niveauExperiences = [
            'Etudiant, jeune diplômé',
            'Débutant < 2 ans',
            'Expérience entre 2 ans et 5 ans',
            'Expérience entre 5 ans et 10 ans',
            'Expérience > 10 ans',
        ];
        $niveauEtudes = [
            'Qualification avant bac',
            'Bac',
            'Bac+1',
            'Bac+2',
            'Bac+3',
            'Bac+4',
            'Bac+5 et plus',
        ];

        $genres = ['male', 'female'];
        $types = ['candidat', 'entreprise'];

        /* foreach ($metiers as $key => $value) {
            $metier = new Metier();

            $metier->setLibele($value);
            $manager->persist($metier);
        };
        foreach ($regions as $key => $value) {
            $region = new Region();

            $region->setLibele($value);
            $manager->persist($region);
        };
        foreach ($typeContrats as $key => $value) {
            $typeContrat = new TypeContrat();

            $typeContrat->setLibelle($value);
            $manager->persist($typeContrat);
        };
        foreach ($secteurActivites as $key => $value) {
            $secteurActivite = new SecteurActivite();

            $secteurActivite->setLibele($value);
            $manager->persist($secteurActivite);
        };
        foreach ($langues as $key => $value) {
            $langue = new Langue();

            $langue->setLibele($value)
                    ->setNiveau(100);
            $manager->persist($langue);
        };
        foreach ($niveauExperiences as $key => $value) {
            $niveauExperience = new NiveauExperience();

            $niveauExperience->setLibelle($value);
            $manager->persist($niveauExperience);
        };
        foreach ($niveauEtudes as $key => $value) {
            $niveauEtude = new NiveauEtude();

            $niveauEtude->setLibele($value);
            $manager->persist($niveauEtude);
        }; */

          /* for ($i=1; $i < 5; $i++) {
            $user = new User();
            $hash = $this->encoder->encodePassword($user, 'password');
            $user->setFirstName($faker->firstNameFemale)
                ->setLastName($faker->lastName)
                ->setNumTel($faker->phoneNumber)
                ->setAddress($faker->address)
                ->setEmail($faker->email)
                ->setHash($hash)
                ->setCivilite('Mrs')
                ->setCodePostal($faker->postcode)
                ->setPays('Sénégal')
                ->setVille($faker->randomElement($regions))
                ->setNationalite('Sénégalais')
                ;
            $type = $faker->randomElement($types);
            //$type = 'candidat';
            if ($type == 'candidat') {
                $picture = 'https://randomuser.me/api/portraits/men/';
                $pictureId = $faker->numberBetween(1, 99) . '.jpg';

                $picture .=  $pictureId;

                $candidat = new candidat();

                $candidat->setUser($user)
                        ->setDateNaiss($faker->date($format = 'Y-m-d', $max = '1998-01-01'))
                        ->setPicture($picture)

                ;

                $critere = new Critere();
                $langue = new Langue();
                //$langue_1 = $repolangue->find(2);
                $critere->setCandidat($candidat)
                ;
                $cv = new Cv();

                $cv->setCandidat($candidat)
                ;
                for ($i=1; $i <= mt_rand(1,3); $i++) {
                    $formation = new Formation;
                    $formation->setNomEcole($faker->randomElement($schools))
                            ->setTitre($faker_1->bs)
                            ->setDateDebut($faker->dateTime($format = 'Y-m-d', $max = 'now'))
                            ->setDateFin($faker->dateTime($format = 'Y-m-d', $max = 'now'))
                            ->setDescription($faker->paragraph(2))
                            ->setCv($cv)
                    ;
                    $manager->persist($formation);
                }
                for ($i=1; $i <=mt_rand(1,3); $i++) {
                    $experience = new Experience;
                    $experience->setEntreprise($faker->randomElement($entreprises))
                            ->setPoste($faker->catchPhrase)
                            ->setDateDebut($faker->dateTime($format = 'Y-m-d', $max = 'now'))
                            ->setDateFin($faker->dateTime($format = 'Y-m-d', $max = 'now'))
                            ->setDescription($faker->paragraph(2))
                            ->setCv($cv)

                    ;
                    $manager->persist($experience);
                }
                $manager->persist($cv);
                $manager->persist($critere);
                $manager->persist($candidat);
            }else{

                $picture = 'https://pigment.github.io/fake-logos/logos/medium/color/';
                $pictureId = $faker->numberBetween(1, 12) . '.png';
                $picture .=  $pictureId;


                $entreprise = new Entreprise();
                $entreprise->setNom($faker->randomElement($entreprises))
                            ->setSite($faker->domainName)
                            ->setUser($user)
                            ->setDescription($faker->paragraph(mt_rand(2,3)))
                            ->setPicture($picture)
                            ->setCodePostal($faker->postcode)
                            ->setPays('Sénégal')
                            ->setVille($faker->randomElement($regions))

                ;
                for ($i=0; $i <mt_rand(3,6) ; $i++) {
                    $offre = new OffreEmploi();
                    $offre->setEntreprise($entreprise)
                            ->setPoste($faker->randomElement($metiers))
                            ->setNbPoste(mt_rand(1,15))
                            ->setDescriptionPoste($faker->sentence())
                            ->setDescriptionProfil($faker->sentence())
                    ;
                    $manager->persist($offre);
                }
                $manager->persist($entreprise);
            }
        } */
        $adminRole = new Role();
        $adminRole->setTitle('ROLE_ADMIN');
        $manager->persist($adminRole);
        
        $adminUser = new User();
            $hash = $this->encoder->encodePassword($adminUser, 'password');
            $adminUser->setFirstName('Cheikh Ahmed')
                ->setLastName('Thiombane')
                ->setNumTel('77 298 64 18')
                ->setEmail('cheikhahmed@symfony.com')
                ->setHash($hash)
                ->setCivilite('Mrs')
                ->addUserRole($adminRole)
                ;
        $manager->persist($adminUser);
        $manager->flush();

    }
}
