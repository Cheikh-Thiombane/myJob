<?php

namespace App\Controller;

use App\Entity\Cv;
use App\Entity\User;
use App\Entity\Candidat;
use App\Entity\Entreprise;
use App\Form\CandidatType;
use App\Form\RecruteurType;
use App\Form\RegistrationCandidatType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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

    #[Route('/register/candidat', name:'account_register_candidat')]
    public function registerCandidat(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
        $candidat = new Candidat();
        $user = new User();

        $form = $this->createForm(CandidatType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $password = $encoder->encodePassword($user, $user->getPasswordUser());
            $user->setPasswordUser($password);
            $user->setCandidat($candidat);
            $candidat->setUser($user);
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
    public function registerEntreprise(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
        $entreprise = new Entreprise();
        $user = new User();

        $form = $this->createForm(RecruteurType::class, ['user' => $user, 'entreprise' => $entreprise]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $password = $encoder->encodePassword($user, $user->getPasswordUser());
            $user->setPasswordUser($password);
            $userEntreprise = $this->getUser();
            $entreprise->setUser($userEntreprise);
            $manager->persist($user);
            $manager->persist($entreprise);

            $manager->flush();

            $this->addFlash(
                'success', "Votre compte a bien été créé ! Vous pouvez maintenant vous connecter !"
            );

            return $this->redirectToRoute('account_login');
        }

        return $this->render('account/registrationEntreprise.html.twig', [
            'form' => $form->createView()
        ]);
    }
    #[Route('/account/edit', name:'my_account')]
    public function myAccount(Candidat $candidat, Request $request, EntityManagerInterface $manager){

        $user = $this->getUser();
        $candidat->setUser($user);
        $cv = $candidat->getCv();

        $form = $this->createForm(CvType::class, $cv);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            foreach ($cv->getFormations() as $formation) {
                $formation->setCv($cv);
                $manager->persist($formation);
            }
            foreach ($cv->getExperiences() as $experience) {
                $experience->setCv($cv);
                $manager->persist($experience);
            }

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
            'candidat' => $candidat,
            'form' => $form->createView()
            //'offres' => $offres
        ]);
    }
}
