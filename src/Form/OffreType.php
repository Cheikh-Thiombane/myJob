<?php

namespace App\Form;

use App\Entity\Langue;
use App\Entity\Metier;
use App\Entity\Region;
use App\Entity\OffreEmploi;
use App\Entity\TypeContrat;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Form\DataTransformer\FrenchToDateTimeTransformer;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class OffreType extends ApplicationType
{
    private $transformer;

    public function __construct(FrenchToDateTimeTransformer $transformer)
    {
        $this->transformer = $transformer;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('poste',TextType::class,$this->getConfiguration('Poste'))
            ->add('nbPoste',IntegerType::class,$this->getConfiguration('Nombre Poste'))
            ->add('descriptionPoste',TextareaType::class,$this->getConfiguration('Description du poste'))
            ->add('descriptionProfil',TextareaType::class,$this->getConfiguration('Description du profil'))
            ->add('renumeration',IntegerType::class,$this->getConfiguration('Renumeration'))
            ->add('endDate',TextType::class,$this->getConfiguration('Date limite'))
            ->add('secteurActivites',EntityType::class,[
                'class'     => 'App\Entity\SecteurActivite',
                'multiple' => true,
                //'expanded' => true,
                'required' => true
            ],$this->getConfiguration(''))
            ->add('metier',EntityType::class,[
                'class'     => 'App\Entity\Metier',
                'required' => true
            ],$this->getConfiguration(''))
            ->add('langues',EntityType::class,[
                'class'     => 'App\Entity\Langue',
                'multiple' => true,
                //'expanded' => true,
                'required' => true
            ],$this->getConfiguration(''))
            ->add('region',EntityType::class,[
                'class'     => 'App\Entity\Region',
                //'multiple' => true,
                //'expanded' => true,
                'required' => true
            ],$this->getConfiguration(''))
            ->add('typeContrat',EntityType::class,[
                'class'     => 'App\Entity\TypeContrat',
                //'multiple' => true,
                //'expanded' => true,
                'required' => true
            ],$this->getConfiguration(''));
            $builder->get('endDate')->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => OffreEmploi::class,
        ]);
    }
}
