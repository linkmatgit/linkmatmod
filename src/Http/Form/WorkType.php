<?php

namespace App\Http\Form;

use App\Entity\Work\Work;
use App\Http\Type\EditorType;
use App\Repository\Forum\ForumTagRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class WorkType extends AbstractType
{


    public function __construct(private ForumTagRepository $tagRepository)
    {

    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $tags = $this->tagRepository->findAllOrdered();
        $builder
            ->add('name', TextType::class)
            ->add('content', EditorType::class)
            ->add('statut', ChoiceType::class,[
                'required' => true,
                'choices' => array_flip(Work::$status),
            ])
        ->add('approved', ChoiceType::class,[
        'required' => true,
        'choices' => array_flip(Work::$confirm),
    ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Work::class,
        ]);
    }
}