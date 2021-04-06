<?php

namespace App\Form;

use App\Entity\Cv;
use App\Entity\NiveauEtude;
use App\Form\FormationType;
use App\Form\ExperienceType;
use App\Entity\NiveauExperience;
use App\Form\NiveauExperienceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class CvType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('niveauEtude',EntityType::class,[
                'class'=> 'App\Entity\NiveauEtude'
            ],$this->getConfiguration(''))
            ->add('formations',CollectionType::class,
            [
                'entry_type' => FormationType::class,
                'allow_add' => true,
                'allow_delete' => true,
            ])
            ->add('niveauExperience',EntityType::class, [
                'class'=> 'App\Entity\NiveauExperience'
            ],$this->getConfiguration(''))
            ->add('experiences',CollectionType::class,
            [
                'entry_type' => ExperienceType::class,
                'allow_add' => true,
                'allow_delete' => true,

            ] )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cv::class,
        ]);
    }
}
