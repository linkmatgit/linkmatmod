<?php


namespace App\Entity\Forum\Entity;


use App\Entity\Auth\User;
use App\Repository\Forum\ForumTagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Doctrine\Common\Collections\Collection;
use JetBrains\PhpStorm\Pure;

#[Entity(repositoryClass: ForumTagRepository::class)]
#[Table('forum_tag')]
class ForumTag {

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[Column(type: Types::INTEGER)]
    private ?int $id;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $title;

    #[ORM\Column(type: Types::TEXT)]
    private string $slug = ' ';

    #[ORM\Column(type: Types::INTEGER)]
    private ?int $position;


    #[ORM\Column(type: Types::TEXT)]
    private string $description;

    #[ORM\Column(type: Types::BOOLEAN, options: ['default' => 0])]
    private bool $online = false;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private ?User $creator;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $createdAt;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $updatedAt;

    #[ORM\ManyToOne(targetEntity: ForumTag::class, inversedBy: 'children')]
    private ?ForumTag $parent = null;

    #[ORM\OneToMany(mappedBy: 'parent', targetEntity: ForumTag::class)]
    private Collection $children;


    #[ORM\ManyToMany(targetEntity: ForumTopic::class, mappedBy: 'tags')]
    private Collection $topics;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $color = null;



    public function __construct()
    {
        $this->topics = new ArrayCollection();
        $this->children = new ArrayCollection();
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
     * @return ForumTag
     */
    public function setId(?int $id): ForumTag
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
     * @return ForumTag
     */
    public function setTitle(?string $title): ForumTag
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
     * @return ForumTag
     */
    public function setSlug(string $slug): ForumTag
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPosition(): ?int
    {
        return $this->position;
    }

    /**
     * @param int|null $position
     * @return ForumTag
     */
    public function setPosition(?int $position): ForumTag
    {
        $this->position = $position;
        return $this;
    }


    public function getDescription(): ?string
    {
        return $this->description;
    }


    public function setDescription(?string $description): ForumTag
    {
        $this->description = $description;
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
     * @return ForumTag
     */
    public function setOnline(bool $online): ForumTag
    {
        $this->online = $online;
        return $this;
    }

    /**
     * @return User|null
     */
    public function getCreator(): ?User
    {
        return $this->creator;
    }

    /**
     * @param User|null $creator
     * @return ForumTag
     */
    public function setCreator(?User $creator): ForumTag
    {
        $this->creator = $creator;
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
     * @return ForumTag
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): ForumTag
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
     * @return ForumTag
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt): ForumTag
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return ForumTag|null
     */
    public function getParent(): ?ForumTag
    {
        return $this->parent;
    }

    /**
     * @param ForumTag|null $parent
     * @return ForumTag
     */
    public function setParent(?ForumTag $parent): ForumTag
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * @return ArrayCollection|Collection
     */
    public function getChildren(): ArrayCollection|Collection
    {
        return $this->children;
    }

    /**
     * @param ArrayCollection|Collection $children
     * @return ForumTag
     */
    public function setChildren(ArrayCollection|Collection $children): ForumTag
    {
        $this->children = $children;
        return $this;
    }

    /**
     * @return ArrayCollection|Collection
     */
    public function getTopics(): ArrayCollection|Collection
    {
        return $this->topics;
    }

    /**
     * @param ArrayCollection|Collection $topics
     * @return ForumTag
     */
    public function setTopics(ArrayCollection|Collection $topics): ForumTag
    {
        $this->topics = $topics;
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
     * @return ForumTag
     */
    public function setColor(?string $color): ForumTag
    {
        $this->color = $color;
        return $this;
    }

}