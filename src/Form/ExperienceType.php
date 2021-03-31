<?php

namespace App\Form;

use App\Entity\Experience;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExperienceType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('poste', TextType::class,$this->getConfiguration("Poste"))
            ->add('entreprise', TextType::class,$this->getConfiguration("Poste"))
            ->add('dateDebut', DateType::class,$this->getConfiguration("Date Début"))
            ->add('dateFin',DateType::class,$this->getConfiguration("Date Début"))
            ->add('description',TextareaType::class,$this->getConfiguration("Description"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Experience::class,
        ]);
    }
}
