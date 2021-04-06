<?php

namespace App\Form;

use App\Entity\Entreprise;
use App\Entity\User;
use App\Form\EntrepriseType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RecruteurType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('civilite',ChoiceType::class,[
                'choices'  => [
                '<< Civilité >>' => null,
                'Mrs' => 'Mrs',
                'Mme' => 'Mme',
                'Mlle' => 'Mlle',
            ],'attr' =>[

                'class' => 'form-control',
                'required'
            ]])
            ->add('firstName',TextType::class, $this->getConfiguration("Prénom"))
            ->add('lastName',TextType::class, $this->getConfiguration("Nom"))
            ->add('numTel',TelType::class, $this->getConfiguration("70 200 10 32"))
            ->add('email',EmailType::class, $this->getConfiguration("Email"))
            ->add('hash',PasswordType::class, $this->getConfiguration("Mot de passe"))
            ->add('passwordConfirm',PasswordType::class, $this->getConfiguration("confirmer Mot de passe"))
            //->add('ville',TextType::class, $this->getConfiguration("Ville"))
           // ->add('pays',TextType::class, $this->getConfiguration("Pays"))
            //->add('codePostal',TextType::class, $this->getConfiguration("Code Postal"))
            //->add('entreprise',EntrepriseType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
