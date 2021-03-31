<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;


class ApplicationType extends AbstractType
{

   /**
     * Permet la configuration de base d'un Champ
     *
     * @param string $placeholder
     * @param array $options
     * @return array
     */
    protected function getConfiguration( $placeholder, $options = [])
    {
        return array_merge([
            'attr' =>[
                'placeholder' => $placeholder,
                'class' => 'form-control required'
            ]
        ], $options);
    }

}

