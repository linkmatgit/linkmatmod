<?php

namespace App\Entity\Attachment\Type;

use App\Entity\Attachment\Attachment;
use App\Entity\Attachment\Validator\AttachmentExist;
use App\Entity\Attachment\Validator\NonExistingAttachment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;
class AttachmentType extends TextType implements DataTransformerInterface
{
    private EntityManagerInterface $em;
    private UploaderHelper $uploaderHelper;
    private string $adminPrefix;

    public function __construct(
        EntityManagerInterface $em,
        UploaderHelper $uploaderHelper,
        string $adminPrefix
    ) {
        $this->em = $em;
        $this->uploaderHelper = $uploaderHelper;
        $this->adminPrefix = $adminPrefix;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addViewTransformer($this);
        parent::buildForm($builder, $options);
    }

    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        if (null !== $form->getData()) {
            $view->vars['attr']['preview'] = $this->uploaderHelper->asset($form->getData());
        }
        $view->vars['attr']['overwrite'] = true;
        parent::buildView($view, $form, $options);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'required' => false,
            'attr' => [
                'is' => 'input-attachment',
                'data-endpoint' => '/'.trim($this->adminPrefix, '/').'/attachment',
            ],
            'constraints' => [
                new AttachmentExist(),
            ],
        ]);
        parent::configureOptions($resolver);
    }

    /**
     * @param ?Attachment $attachment
     */
    public function transform($attachment): ?int
    {
        if ($attachment instanceof Attachment) {
            return $attachment->getId();
        }

        return null;
    }

    /**
     * @param int $value
     */
    public function reverseTransform($value): ?Attachment
    {
        if (empty($value)) {
            return null;
        }

        return $this->em->getRepository(Attachment::class)->find($value) ?: new NonExistingAttachment($value);
    }
}