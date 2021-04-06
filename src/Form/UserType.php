<?php

namespace App\Form;

use App\Entity\User;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends ApplicationType
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
            ->add('codePostal',TextType::class, $this->getConfiguration_1("Code Postal"))
            ->add('pays',TextType::class, $this->getConfiguration_1("Pays"))
            ->add('ville',TextType::class, $this->getConfiguration_1("Ville"))
            ->add('address',TextType::class,$this->getConfiguration_1("Adresse"))
            ->add('nationalite',TextType::class,$this->getConfiguration_1("Nationalité"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
