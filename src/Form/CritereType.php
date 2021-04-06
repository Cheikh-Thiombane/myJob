<?php

namespace App\Form;

use App\Entity\Langue;
use App\Entity\Metier;
use App\Entity\Region;
use App\Entity\Critere;
use App\Entity\TypeContrat;
use App\Entity\SecteurActivite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CritereType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('renumeration',IntegerType::class,$this->getConfiguration(''))
            ->add('disponiblilite',TextType::class,$this->getConfiguration(''),)
            //->add('candidat')
            ->add('secteurActivites',EntityType::class,[
                'class'     => 'App\Entity\SecteurActivite',
                'multiple' => true,
                'expanded' => true,
                'required' => true
            ],$this->getConfiguration(''))
            ->add('metier',EntityType::class,[
                'class'     => 'App\Entity\Metier'
            ],$this->getConfiguration(''))
            ->add('langues',EntityType::class,[
                'class'     => 'App\Entity\Langue',
                'multiple' => true,
                //'expanded' => true,
                'required' => true
            ],$this->getConfiguration(''))
            ->add('mobilites',EntityType::class,[
                'class'     => 'App\Entity\Region',
                'multiple' => true,
                'expanded' => true,
                'required' => true
            ],$this->getConfiguration(''))
            ->add('typeContrats',EntityType::class,[
                'class'     => 'App\Entity\TypeContrat',
                'multiple' => true,
                'expanded' => true,
                'required' => true
            ],$this->getConfiguration(''))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Critere::class,
        ]);
    }
}
