<?php

namespace App\Http\Admin\Data;


use App\Entity\Auth\User;
use App\Entity\Mods\Entity\ModsCategory;
use App\Http\Form\AutomaticForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraints as Assert;

class ModCategoryCrudData implements CrudDataInterface
{
    #[Assert\NotBlank]
    public ?string $name = null;

    private EntityManagerInterface $em;


    public ?string $slug = null;

    public ?ModsCategory $parent;

    public bool $online;

    public ?\DateTimeInterface $createdAt;

    #[Assert\NotBlank]
    public ?User $author;

    #[Assert\NotBlank]
    public ?string $description = null;

    private ModsCategory $entity ;

    public function  __construct(ModsCategory $category)
    {
        $this->entity = $category;
        $this->name = $category->getName();
        $this->createdAt = $category->getCreatedAt();
        $this->description = $category->getDescription();
        $this->author = $category->getAuthor();
        $this->parent = $category->getParent();
        $this->online = $category->isOnline();
        $this->slug = $category->getSlug();
    }
    public function hydrate(): void
    {

        $this->entity->setName($this->name);
        $this->entity->setCreatedAt($this->createdAt);
        $this->entity->setDescription($this->description);
        $this->entity->setUpdatedAt(new \DateTime());
        $this->entity->setAuthor($this->author);
        $this->entity->setParent($this->parent);
        $this->entity->setOnline($this->online);
        $this->entity->setSlug($this->slug);

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