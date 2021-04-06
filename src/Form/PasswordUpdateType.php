<?php

namespace App\Form;

use App\Form\ApplicationType;
use App\Entity\PasswordUpdate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class PasswordUpdateType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('oldPassword', PasswordType::class, $this->getConfiguration( "Donnez votre mot de passe actuelle"))
        ->add('newPassword', PasswordType::class, $this->getConfiguration( "Donnez votre nouveau mot de passe"))
        ->add('confirmPassword', PasswordType::class, $this->getConfiguration( "Confirmer votre nouveau mot de passe"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PasswordUpdate::class,
        ]);
    }
}
