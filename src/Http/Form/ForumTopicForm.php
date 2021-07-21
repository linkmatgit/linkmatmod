<?php

namespace App\Http\Form;

use App\Entity\Forum\Entity\ForumTag;
use App\Entity\Forum\Entity\ForumTopic;
use App\Http\Type\EditorType;
use App\Repository\Forum\ForumTagRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ForumTopicForm extends AbstractType
{


    public function __construct(private ForumTagRepository $tagRepository)
    {

    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $tags = $this->tagRepository->findAllOrdered();
        $builder
            ->add('name', TextType::class)
            ->add('tags', EntityType::class, [
                'required' => false,
                'multiple' => true,
                'attr' => [
                    'data-limit' => 3,
                ],
                'class' => ForumTag::class,
                'choices' => $tags,
                'query_builder' => null,
                'choice_label' => function (ForumTag $tag) {
                    $prefix = $tag->getParent() ? '⠀⠀' : '';

                    return $prefix.$tag->getTitle();
                },
            ])
            ->add('content', EditorType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ForumTopic::class,
        ]);
    }
}