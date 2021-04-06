<?php

namespace App\Form;

use App\Entity\Entreprise;
use App\Form\CandidatType;
use App\Form\ApplicationType;
use App\Entity\SecteurActivite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class EntrepriseType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class, $this->getConfiguration("Nom de l'entreprise"))
            ->add('site',TextType::class, $this->getConfiguration("Site de l'entreprise"))
            ->add('codePostal',TextType::class, $this->getConfiguration("Code Postal"))
            ->add('pays',TextType::class, $this->getConfiguration("Pays"))
            ->add('ville',TextType::class, $this->getConfiguration("Ville"))
            ->add('description',TextareaType::class, $this->getConfiguration("Description détaillé"))
            ->add('secteurActivite',EntityType::class,[
                'class'     => 'App\Entity\SecteurActivite',
                'multiple' => true,
                'expanded' => true,
                'required' => true
            ],$this->getConfiguration(''))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Entreprise::class,
        ]);
    }
}
