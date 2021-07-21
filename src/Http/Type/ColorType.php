<?php

namespace App\Http\Type;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ColorType extends TextareaType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);
        $resolver->setDefaults([
            'html5' => false,
            'attr' => [
                'is' => 'color-picker',
            ],
        ]);
    }
}