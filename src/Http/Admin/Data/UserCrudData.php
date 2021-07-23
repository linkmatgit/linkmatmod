<?php

namespace App\Http\Admin\Data;

use App\Entity\Attachment\Attachment;
use App\Entity\Auth\User;
use App\Entity\Blog\Post;
use App\Http\Form\AutomaticForm;
use Doctrine\ORM\EntityManagerInterface;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;

class UserCrudData implements CrudDataInterface
{
    #[Assert\NotBlank]
    public string $username;

    private EntityManagerInterface $em;

    #[Assert\NotBlank]
    public string $email;

    public bool $isVerified;

    private File $avatarFile;

    public ?\DateTimeInterface $createdAt;

    #[Assert\NotBlank]
    public ?string $theme = null;

    private User $entity ;

    public string $country;

    public function  __construct(User $rows)
    {
        $this->entity = $rows;
        $this->email = $rows->getEmail();
        $this->username = $rows->getUsername();
        $this->country = $rows->getCountry();

    }
    public function hydrate(): void
    {
        $this->entity->setCountry($this->country);
        $this->entity->setEmail($this->email);
        $this->entity->setUsername($this->username);

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



}