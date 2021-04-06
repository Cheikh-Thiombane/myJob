<?php

namespace App\Form;

use App\Entity\Formation;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class FormationType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateDebut',TextType::class, $this->getConfiguration("Date Debut"))
            ->add('titre', TextType::class, $this->getConfiguration("Titre de la formation"))
            ->add('nomEcole',TextType::class, $this->getConfiguration("Titre de la formation"))
            ->add('dateFin',TextType::class, $this->getConfiguration("Date Fin"))
            ->add('description',TextareaType::class,$this->getConfiguration("Description"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
        ]);
    }
}
