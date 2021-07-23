<?php

namespace App\Http\Form\Field;


use App\Entity\Mods\Entity\ModsCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModCategoryType extends EntityType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);
        $resolver->setDefaults([
            'class' => ModsCategory::class,
            'placeholder' => 'Choose an option',
            'multiple' => false,
            'choice_label' => 'name',
        ]);
    }
}