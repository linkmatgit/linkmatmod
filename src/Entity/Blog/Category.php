<?php

namespace App\Entity\Blog;


use App\Entity\Auth\User;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use JetBrains\PhpStorm\Pure;

#[Entity(repositoryClass: CategoryRepository::class)]
#[Table("blog_category")]
class Category
{
    #[Id]
    #[GeneratedValue(strategy: "IDENTITY")]
    #[Column(type: 'integer')]
    private ?int $id = null;

    #[Column(type: 'string')]
    private ?string $name = null;

    #[Column(type: 'string')]
    private ?string $color =  null;

    #[Column(type: 'string', unique: true)]
    private ?string $slug = null;

    #[Column(type: 'datetime')]
    private ?\DateTimeInterface $createdAt = null;

    #[Column(type: 'datetime')]
    private ?\DateTimeInterface $updatedAt;

    #[Column(type: 'text')]
    private ?string $description = null;

    #[ManyToOne(targetEntity: User::class)]
    #[JoinColumn(name: 'user_id', referencedColumnName: 'id', onDelete: 'SET NULL')]
    private ?User $author = null;

    #[OneToMany(mappedBy: 'category', targetEntity: Post::class)]
    private ?Collection $posts = null;

    #[Column(type: Types::INTEGER,  options: ['default' => 0])]
    private ?int $postsCount = 0;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }



    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Category
     */
    public function setId(?int $id): Category
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return Category
     */
    public function setName(?string $name): Category
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getColor(): ?string
    {
        return $this->color;
    }

    /**
     * @param string|null $color
     * @return Category
     */
    public function setColor(?string $color): Category
    {
        $this->color = $color;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @param string|null $slug
     * @return Category
     */
    public function setSlug(?string $slug): Category
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeInterface|null $createdAt
     * @return Category
     */
    public function setCreatedAt(?\DateTimeInterface $createdAt): Category
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTimeInterface|null $updatedAt
     * @return Category
     */
    public function setUpdatedAt(?\DateTimeInterface $updatedAt): Category
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return Category
     */
    public function setDescription(?string $description): Category
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return ArrayCollection|Collection|null
     */
    public function getPosts(): ArrayCollection|Collection|null
    {
        return $this->posts;
    }

    /**
     * @param ArrayCollection|Collection|null $posts
     * @return Category
     */
    public function setPosts(ArrayCollection|Collection|null $posts): Category
    {
        $this->posts = $posts;
        return $this;
    }
    /**
     * @return User|null
     */
    public function getAuthor(): ?User
    {
        return $this->author;
    }

    /**
     * @param User|null $author
     * @return Category
     */
    public function setAuthor(?User $author): Category
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPostsCount(): ?int
    {
        return $this->postsCount;
    }

    /**
     * @param int|null $postsCount
     * @return Category
     */
    public function setPostsCount(?int $postsCount): Category
    {
        $this->postsCount = $postsCount;
        return $this;
    }



}
