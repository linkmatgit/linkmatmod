<?php

namespace App\Http\Admin\Data;

use App\Entity\Auth\User;
use App\Entity\Work\Work;
use App\Http\Form\AutomaticForm;
use Doctrine\ORM\EntityManagerInterface;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Validator\Constraints as Assert;

class WorkCrudData implements CrudDataInterface
{
    #[Assert\NotBlank]
    public ?string $name = null;

    private EntityManagerInterface $em;

    public ?\DateTimeInterface $createdAt;

    #[Assert\NotBlank]
    public ?User $author;

    #[Assert\NotBlank]
    public ?string $content = null;

    public bool $approuve = false;

    private Work $entity ;



    #[Pure]
    public function  __construct(Work $rows)
    {
        $this->entity = $rows;
        $this->name = $rows->getName();
        $this->author = $rows->getAuthor();

    }
    public function hydrate(): void
    {


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

    public function setAuthor(User $author): PostCrudData
    {
        $this->author = $author;

        return $this;
    }
}