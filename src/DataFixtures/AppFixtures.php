<?php

namespace App\DataFixtures;

use App\Entity\Candidat;
use App\Entity\Cv;
use App\Entity\Entreprise;
use App\Entity\Experience;
use App\Entity\Formation;
use App\Entity\OffreEmploi;
use Faker\Factory;
use App\Entity\User;
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
        $faker = Factory::create('fr_FR');
        $faker_1 = Factory::create('en_US');

        //Nous gerons les users
        $users = [];
        $schools = ['Institut superieur informatique', 'Ecole national d\'aviation',
        'Institut Privé de Gestion (IPG)','Ecole des Hautes Etudes de Gestion ( H .E.G)','Institution Sainte Jeanne d’Arc',
        'Institut de Formation et d’Assistance AFI','Institut Supérieur de Management ISM'];
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
        $genres = ['male', 'female'];
        $types = ['candidat', 'entreprise'];

        for ($i=1; $i <=10 ; $i++) {
            $user = new User();

            $genre = $faker->randomElement($genres);

            $picture = 'https://randomuser.me/api/portraits/';
            $pictureId = $faker->numberBetween(1, 99) . '.jpg';

            $picture .=  ($genre == 'male' ? 'men/' : 'women/') . $pictureId;
            $civilite = 'Title'.($genre == 'male' ? 'Male' : 'Female');

            $hash = $this->encoder->encodePassword($user, 'password');

            $user->setFirstName($faker->firstname)
                ->setLastName($faker->lastname)
                ->setEmail($faker->email)
                ->setCivilite($faker->$civilite)
                ->setAddress($faker->address)
                ->setVille($faker->city)
                ->setCodePostal($faker->postcode)
                ->setPays('Sénégal')
                ->setNumTel($faker->phoneNumber)
                ->setHash($hash)
                ;




            $type = $faker->randomElement($types);

            if ($type == "candidat") {
                $candidat = new Candidat();

                //$title = $faker->sentence();

                $coverImage = $faker->imageUrl(500,300);
                $introduction = $faker->paragraph(2);
                $content = '<p>' . join('</p><p>', $faker->paragraphs(5)).'</p>';

                //$user = $users[mt_rand(0, count($users) - 1)];

                $candidat->setUser($user)
                    ->setPicture($picture)
                    ->setDateNaiss($faker->dateTime($max = 'now', $timezone = null))
                    ;


                        $cv = new Cv();



                        $cv->setNiveauEtude(mt_rand(1, 5))
                            ->setCandidat($candidat)
                            ->setNiveauExperience(mt_rand(1, 5))
                            ;


                        for ($j=1; $j<= mt_rand(1, 4) ; $j++) {
                            $formation = new Formation();

                            $formation->setTitre($faker_1->bs)
                                ->setNomEcole($faker->randomElement($schools))
                                ->setDateDebut($faker->dateTime($max = 'now', $timezone = null))
                                ->setDateFin($faker->dateTime($max = 'now', $timezone = null))
                                ->setCv($cv)
                                ;

                            $manager->persist($formation);
                        }
                        for ($j=1; $j<= mt_rand(1, 4) ; $j++) {
                            $experience = new Experience();

                            $experience->setPoste($faker_1->bs)
                                ->setEntreprise($faker->randomElement($entreprises))
                                ->setDateDebut($faker->dateTime($max = 'now', $timezone = null))
                                ->setDateFin($faker->dateTime($max = 'now', $timezone = null))
                                ->setCv($cv);

                            $manager->persist($experience);
                        }
                    // $product = new Product();

                    $manager->persist($cv);
                    $manager->persist($candidat);
            }else{
                $entreprise = new Entreprise();

                $title = $faker->sentence();

                $coverImage = $faker->imageUrl(300,150);
                $introduction = $faker->paragraph(2);
                $content = '<p>' . join('</p><p>', $faker->paragraphs(5)).'</p>';


                //$secAc2 = ['1' => $genre = $faker->randomElement($secAc),'2' =>$genre = $faker->randomElement($secAc) ];
                $entreprise->setUser($user)
                    ->setPicture($coverImage)
                    ->setDescription($content)
                    ->setNom($faker->randomElement($entreprises))
                    ->setSecteurActivite([$faker->randomElement($secteur_activites, mt_rand(2,3))])
                    ->setSite($faker->domainName)
                    ;

                for ($i=0; $i < mt_rand(0,10) ; $i++) {
                    $offre = new OffreEmploi();
                    $sec_0 = [];
                    $sec_0  = $faker->randomElement($secteur_activites, mt_rand(2,4));
                    $offre->setPoste($faker->sentence(6, true))
                          ->setRegion($faker->randomElement($regions))
                          ->setNbPoste(mt_rand(1,10))
                          ->setSecteurActivite([$faker->randomElement($secteur_activites, mt_rand(2,4))])
                          ->setTypeContrat($faker->randomElement($typeContrats))
                          ->setDescriptionPoste($faker->paragraph(2))
                          ->setDescriptionProfil($faker->paragraph(2))
                          ->setNiveauExperience(mt_rand(0,4))
                          ->setNiveauEtude(mt_rand(0,6))
                          ->setLangues([$faker->randomElement($langues, mt_rand(1,2))])
                          ->setMetier([$faker->randomElement($secteur_activites, mt_rand(1,4))])
                          ->setEntreprise($entreprise)
                          ->addCandidat($user->getCandidat())
                    ;
                    $manager->persist($offre);
                }


            $manager->persist($entreprise);
            }

            $manager->persist($user);
            $users[] = $user;
        }


        // Nous gerons les cv




        $manager->flush();

    }
}
