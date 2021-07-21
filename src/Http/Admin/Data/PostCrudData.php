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

class PostCrudData implements CrudDataInterface
{
    #[Assert\NotBlank]
    public ?string $title = null;

    private EntityManagerInterface $em;

    public ?string $slug = null;

    public ?Category $category = null;

    public ?\DateTimeInterface $createdAt;

    #[Assert\NotBlank]
    public ?User $author;

    #[Assert\NotBlank]
    public ?string $content = null;

    public bool $online = false;

    private Post $entity ;

    private ?Attachment $image = null;


    #[Pure]
    public function  __construct(Post $post)
    {
        $this->entity = $post;
        $this->title = $post->getTitle();
        $this->slug = $post->getSlug();
        $this->category = $post->getCategory();
        $this->createdAt = $post->getCreatedAt();
        $this->content = $post->getContent();
        $this->author = $post->getAuthor();
        $this->online = $post->isOnline();
        $this->image = $post->getImage();

    }
    public function hydrate(): void
    {
        $this->entity->setCategory($this->category);
        $this->entity->setTitle($this->title);
           $this->entity->setCreatedAt($this->createdAt);
            $this->entity->setContent($this->content);
            $this->entity->setOnline($this->online);
            $this->entity->setUpdatedAt(new \DateTime());
            $this->entity->setAuthor($this->author);
            $this->entity->setSlug($this->slug);
            $this->entity->setImage($this->image);
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