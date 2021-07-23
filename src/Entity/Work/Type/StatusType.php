<?php

namespace App\Entity\Work\Type;


use App\Entity\Work\Work;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StatusType extends ChoiceType
{


    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);
        $resolver->setDefaults([
            'choices'=> function(?Work $work) {
                return array_flip(Work::$status);
                }
        ]);
    }
}