<?php

namespace App\Controller;

use App\Entity\Cv;
use App\Entity\User;
use App\Form\CvType;
use App\Entity\Critere;
use App\Entity\Candidat;
use App\Form\CritereType;
use App\Entity\Entreprise;
use App\Form\CandidatType;
use App\Entity\NiveauEtude;
use App\Entity\OffreEmploi;
use App\Form\RecruteurType;
use App\Form\EditProfilType;
use App\Form\EntrepriseType;
use App\Entity\PasswordUpdate;
use App\Entity\SecteurActivite;
use App\Entity\NiveauExperience;
use App\Form\PasswordUpdateType;
use Symfony\Component\Form\FormError;
use App\Form\RegistrationCandidatType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\NiveauEtudeRepository;
use App\Repository\OffreEmploiRepository;
use App\Repository\SecteurActiviteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use App\Repository\NiveauExperienceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccountController extends AbstractController
{
    #[Route('/register', name: 'account_home')]
    public function index(): Response
    {
        return $this->render('account/index.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }

    #[Route('/login', name:'account_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $username = $authenticationUtils->getLastUsername();

        //$entreprise = $this->getUser()->getEntreptise();

        return $this->render('account/login.html.twig', [
            'hasError' => $error !== null,
            'username' => $username
        ]);
    }
    #[Route('/logout', name:'account_logout')]
    public function logout()
    {
        //... rien
    }
    #[Route('/account/password-update', name:"account_password")]
    public function updatePassword(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder): Response
    {
        $passwordUpdate = new PasswordUpdate();
        $user  = $this->getUser();
        $form = $this->createForm(PasswordUpdateType::class, $passwordUpdate);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            if (!password_verify($passwordUpdate->getOldPassword(), $user->getHash())) {
                    $form->get('oldPassword')->addError(new FormError("Le mot de passe n'est pas valide"));
            }else {
                $newPassword = $passwordUpdate->getNewPassword();
                $hash = $encoder->encodePassword($user, $newPassword);
                $user->setHash($hash);

                $manager->persist($user);
                $manager->flush();

                $this->addFlash(
                    'success', "Votre mot de passe  a bien été modifier  !! "
                );

                return $this->redirectToRoute('account_logout');
            }
        }

        return $this->render('account/password.html.twig' ,[
            'form' => $form->createView()
        ]);
    }
    #[Route('/cv/edit', name:'edit_cv')]
    public function reditCv(NiveauEtudeRepository $repoNiv,NiveauExperienceRepository $repoEx,Request $request, EntityManagerInterface $manager)
    {


        //$candidat = new Candidat();
        $user = $this->getUser();
        //$candidat->setUser($user);
        $cv = $user->getCandidat()->getCv();
        $niveauExperiences = $repoEx->findAll();
        $niveauEtudes = $repoNiv->findAll();
        $form = $this->createForm(CvType::class, $cv);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
             foreach ($cv->getFormations() as $formation) {
                //$formation->setCv($cv);
                $manager->persist($formation);
            }
            foreach ($cv->getExperiences() as $experience) {
                //$experience->setCv($cv);
                $manager->persist($experience);
            }

            $manager->persist($cv);
            $manager->flush();

            $this->addFlash(
                'success', "Votre compte a bien été créé ! Vous pouvez maintenant vous connecter !"
            );

            return $this->redirectToRoute('my_account');
        }


        //$offres = $repoO->findAll();
        //$user = $entreprise->getUser();
        // $cv = $repo->findOneBySlug($slug);

        return $this->render('account/editCv.html.twig', [
            //'entreprise' => $entreprise,
            'ville' => '',
            'pays' => '',
            'niveauExperiences' => $niveauExperiences,
            'niveauEtudes' => $niveauEtudes,
            'user' => $user,
            //'candidat' => $candidat,
            'cv' => $cv,
            'form' => $form->createView()
            //'offres' => $offres
        ]);

    }
    #[Route('/critere/edit', name:'edit_critere')]
    public function reditCritere(NiveauEtudeRepository $repoNiv,NiveauExperienceRepository $repoEx,Request $request, EntityManagerInterface $manager)
    {


        //$candidat = new Candidat();
        $user = $this->getUser();
        //$candidat->setUser($user);
        $critere = $user->getCandidat()->getCritere();
        $niveauExperiences = $repoEx->findAll();
        $niveauEtudes = $repoNiv->findAll();
        $form = $this->createForm(CritereType::class, $critere);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){


            $manager->persist($critere);
            $manager->flush();

            $this->addFlash(
                'success', "Votre compte a bien été créé ! Vous pouvez maintenant vous connecter !"
            );

            return $this->redirectToRoute('my_account');
        }


        //$offres = $repoO->findAll();
        //$user = $entreprise->getUser();
        // $cv = $repo->findOneBySlug($slug);

        return $this->render('account/editCritere.html.twig', [
            //'entreprise' => $entreprise,
            'ville' => '',
            'pays' => '',
            'niveauExperiences' => $niveauExperiences,
            'niveauEtudes' => $niveauEtudes,
            'user' => $user,
            //'candidat' => $candidat,
            'critere' => $critere,
            'form' => $form->createView()
            //'offres' => $offres
        ]);

    }

    #[Route('/register/candidat', name:'account_register_candidat')]
    public function registerCandidat(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
        $candidat = new Candidat();
        $user = new User();
        $cv = new Cv();
        $critere = new Critere();
        $form = $this->createForm(CandidatType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $password = $encoder->encodePassword($user, $user->getHash());
            $user->setHash($password);
            $user->setCandidat($candidat);
            $candidat->setUser($user);
            $cv->setCandidat($candidat);
            $critere->setCandidat($candidat);
            $manager->persist($cv);
            $manager->persist($critere);
            $manager->persist($candidat);
            $manager->persist($user);


            $manager->flush();

            $this->addFlash(
                'success', "Votre compte a bien été créé ! Vous pouvez maintenant vous connecter !"
            );

            return $this->redirectToRoute('account_login');
        }

        return $this->render('account/registrationCandidat.html.twig', [
            'form' => $form->createView()
        ]);
    }
    #[Route('/register/entreprise', name:'account_register_entreprise')]
    public function registerEntreprise(SecteurActiviteRepository $repoSec ,Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
        $secteurActivites = $repoSec->findAll();
        $entreprise = new Entreprise();
        $user = new User();

        $form = $this->createForm(CandidatType::class,$user);
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
            $password = $encoder->encodePassword($user, $user->getHash());
            $user->setHash($password);
            //$userEntreprise = $this->getUser();
            $entreprise->setUser($user);
            $manager->persist($user);
            $manager->persist($entreprise);

            $manager->flush();

            $this->addFlash(
                'success', "Votre compte a bien été créé ! Vous pouvez maintenant vous connecter !"
            );

            return $this->redirectToRoute('account_login');
            }
        }

        return $this->render('account/registrationEntreprise.html.twig', [
            'form' => $form->createView(),
            'form2' =>$form2->createView(),
            'secteurActivites' => $secteurActivites,
        ]);
    }
    #[Route('/account/view', name:'my_account')]
    public function myAccount(OffreEmploiRepository $repoO,NiveauExperienceRepository $repoEx,Request $request, EntityManagerInterface $manager)
    {
        $candidat = new Candidat();
        $user = $this->getUser();
        $candidat->setUser($user);
        $cv = $candidat->getCv();
        $niveauExperiences = $repoEx->findAll();
        $offres = $candidat->getOffres();
        $form = $this->createForm(CvType::class, $cv);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            /* foreach ($cv->getFormations() as $formation) {
                $formation->setCv($cv);
                $manager->persist($formation);
            }
            foreach ($cv->getExperiences() as $experience) {
                $experience->setCv($cv);
                $manager->persist($experience);
            } */

            $manager->persist($cv);
            $manager->flush();

            $this->addFlash(
                'success', "Votre compte a bien été créé ! Vous pouvez maintenant vous connecter !"
            );

            //return $this->redirectToRoute('account_login');
        }


        //$offres = $repoO->findAll();
        //$user = $entreprise->getUser();
        // $cv = $repo->findOneBySlug($slug);

        return $this->render('account/show.html.twig', [
            //'entreprise' => $entreprise,
            'ville' => '',
            'pays' => '',
            'niveauExperiences' => $niveauExperiences,
            'offres' => $offres,
            'user' => $user,
            'candidat' => $candidat,
            'cv' => $cv,
            'form' => $form->createView()
            //'offres' => $offres
        ]);
    }

    #[Route('/account/edit', name:'edit_profil')]
    public function editProfil(NiveauEtudeRepository $repoNiv,NiveauExperienceRepository $repoEx,Request $request, EntityManagerInterface $manager)
    {
        //$candidat = new Candidat();
        $user = $this->getUser();
        $candidat= $user->getCandidat();
        $cv = $candidat->getCv();
        $niveauExperiences = $repoEx->findAll();
        $niveauEtudes = $repoNiv->findAll();
        $form = $this->createForm(EditProfilType::class, $candidat);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            /* foreach ($cv->getFormations() as $formation) {
                $formation->setCv($cv);
                $manager->persist($formation);
            }
            foreach ($cv->getExperiences() as $experience) {
                $experience->setCv($cv);
                $manager->persist($experience);
            } */
            $manager->persist($user);
            $manager->persist($candidat);
            $manager->flush();

            $this->addFlash(
                'success', "Votre compte a bien été créé ! Vous pouvez maintenant vous connecter !"
            );

            return $this->redirectToRoute('my_account');
        }


        //$offres = $repoO->findAll();
        //$user = $entreprise->getUser();
        // $cv = $repo->findOneBySlug($slug);

        return $this->render('account/editProfil.html.twig', [
            //'entreprise' => $entreprise,
            'ville' => '',
            'pays' => '',
            'niveauExperiences' => $niveauExperiences,
            'niveauEtudes' => $niveauEtudes,
            'user' => $user,
            'candidat' => $candidat,
            'cv' => $cv,
            'form' => $form->createView()
            //'offres' => $offres
        ]);
    }
}
