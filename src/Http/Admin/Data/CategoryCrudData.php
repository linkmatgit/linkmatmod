<?php

namespace App\Http\Admin\Data;

use App\Entity\Attachment\Attachment;
use App\Entity\Auth\User;
use App\Entity\Blog\Category;
use App\Entity\Blog\Post;
use App\Http\Admin\Form\PostFormType;
use App\Http\Form\AutomaticForm;
use Doctrine\ORM\EntityManagerInterface;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Validator\Constraints as Assert;

class CategoryCrudData implements CrudDataInterface
{
    #[Assert\NotBlank]
    public ?string $name = null;

    private EntityManagerInterface $em;

    public ?string $slug = null;

    public ?string $color = null;

    public ?\DateTimeInterface $createdAt;

    #[Assert\NotBlank]
    public ?User $author;

    #[Assert\NotBlank]
    public ?string $description = null;

    private Category $entity ;

    public function  __construct(Category $category)
    {
        $this->entity = $category;
        $this->name = $category->getName();
        $this->slug = $category->getSlug();
        $this->createdAt = $category->getCreatedAt();
        $this->description = $category->getDescription();
        $this->author = $category->getAuthor();
        $this->color = $category->getColor();


    }
    public function hydrate(): void
    {

            $this->entity->setName($this->name);
            $this->entity->setCreatedAt($this->createdAt);
            $this->entity->setDescription($this->description);
            $this->entity->setUpdatedAt(new \DateTime());
            $this->entity->setAuthor($this->author);
            $this->entity->setSlug($this->slug);
            $this->entity->setColor($this->color);
    }

    public function setEntityManager(EntityManagerInterface $em): self
    {
        $this->em = $em;

        return $this;
    }
    public function getEntity(): object
    {
        return $this->entity;
    }

    public function getFormClass(): string
    {
       return AutomaticForm::class;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(User $author): ?User
    {
       return $this->author = $author;
    }
}