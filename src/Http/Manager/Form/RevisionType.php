<?php

namespace App\Http\Manager\Form;

use App\Entity\Work\Work;
use App\Http\Type\EditorType;
use App\Http\Type\TypeTextArea;
use App\Repository\Forum\ForumTagRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RevisionType extends AbstractType
{



    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('statut', ChoiceType::class,[
            'required' => true,
            'choices' => array_flip(Work::$status),
        ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Work::class,
        ]);
    }
}
{

}