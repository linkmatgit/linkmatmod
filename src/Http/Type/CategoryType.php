<?php

namespace App\Http\Type;

use App\Entity\Blog\Category;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends EntityType
{
    public function configureOptions(OptionsResolver $resolver):void
    {
       parent::configureOptions($resolver);
        $resolver->setDefaults([
            'class' => Category::class,
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('c')
                    //->where('c.online = true')
                    ->orderBy('c.name', 'ASC');
            },
            'multiple' => false,
            'choice_label'=> 'name'
        ]);
    }


}