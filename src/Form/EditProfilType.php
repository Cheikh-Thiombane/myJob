<?php

namespace App\Form;

use App\Form\UserType;
use App\Entity\Candidat;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Form\DataTransformer\FrenchToDateTimeTransformer;

class EditProfilType extends ApplicationType
{
    private $transformer;

    public function __construct(FrenchToDateTimeTransformer $transformer)
    {
        $this->transformer = $transformer;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('picture',UrlType::class,$this->getConfiguration_1('picture'))
            ->add('user',UserType::class)
            ->add('dateNaiss',TextType::class,$this->getConfiguration_1('Date Naissance'))
            ->add('fichierCV',FileType::class,$this->getConfiguration_1('format (pdf)'))
        ;
        $builder->get('dateNaiss')->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Candidat::class,
        ]);
    }
}
