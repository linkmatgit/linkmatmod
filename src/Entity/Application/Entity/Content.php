<?php

namespace App\Entity\Application\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Attachment\Attachment;
use App\Entity\Auth\User;
use App\Entity\Blog\Post;
use App\Entity\Mods\Entity\Mods;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ORM\Entity]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: "type", type: "string")]
#[ORM\DiscriminatorMap([
    'post' => Post::class,
    'mods'=> Mods::class
])]
#[ApiResource(
    collectionOperations: [],
    itemOperations: ['get']
)]
abstract class Content
{

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(type: 'integer')]
    #[Groups(['read:comment'])]
    private ?int $id = null;

    #[ORM\Column(type: 'string', unique: true)]
    #[Groups(['read:comment'])]
    private ?string $title =  null;

    #[ORM\Column(type: 'string', unique: true)]
    private string $slug =  '';

    #[ORM\Column(type: 'text')]
    #[NotBlank]
    #[Length(min: 3)]
    private ?string $content =  null;

    #[ORM\ManyToOne(targetEntity: 'App\Entity\Auth\User')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private ?User $author =  null;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $createdAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private bool $online = false;

    #[ORM\ManyToOne(targetEntity: Attachment::class, cascade: ['persist'])]
    #[ORM\JoinColumn(name: 'attachment_id', referencedColumnName: 'id')]
    private ?Attachment $image = null;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
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
     * @return Content
     */
    public function setId(?int $id): Content
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return Content
     */
    public function setTitle(?string $title): Content
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     * @return Content
     */
    public function setSlug(string $slug): Content
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string|null $content
     * @return Content
     */
    public function setContent(?string $content): Content
    {
        $this->content = $content;
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
     * @return Content
     */
    public function setAuthor(?User $author): Content
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeInterface $createdAt
     * @return Content
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): Content
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getUpdatedAt(): \DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTimeInterface $updatedAt
     * @return Content
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt): Content
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return bool
     */
    public function isOnline(): bool
    {
        return $this->online;
    }

    /**
     * @param bool $online
     * @return Content
     */
    public function setOnline(bool $online): Content
    {
        $this->online = $online;
        return $this;
    }

    /**
     * @return Attachment|null
     */
    public function getImage(): ?Attachment
    {
        return $this->image;
    }

    /**
     * @param Attachment|null $image
     * @return Content
     */
    public function setImage(?Attachment $image): Content
    {
        $this->image = $image;
        return $this;
    }
    public  function createSlug($str, $delimiter = '-'){

        $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
        return $slug;

    }



}