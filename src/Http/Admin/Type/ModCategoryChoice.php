<?php

namespace App\Http\Admin\Type;


use App\Entity\Mods\Entity\ModsCategory;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModCategoryChoice extends EntityType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);
        $resolver->setDefaults([
            'class' => ModsCategory::class,
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('mc')
                    ->where('mc.parent IS NULL')
                    ->orderBy('mc.name', 'ASC');
            },
            'choice_label' => 'name',
        ]);
    }
}