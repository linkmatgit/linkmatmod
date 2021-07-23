<?php

namespace App\Entity\Forum\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use App\Entity\Auth\User;
use App\Repository\Forum\ForumTopicRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\Count;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ForumTopicRepository::class)]
#[ORM\Table('forum_topic')]
class ForumTopic {


    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(type: 'integer')]
    #[ApiProperty(identifier: true)]
    #[Groups(['read:topic'])]
    private ?int $id;

    #[ORM\Column(type: 'string')]
    #[Groups(['read:topic'])]
    private  string $name;

    #[ORM\Column(type: 'text')]
    #[Groups(['read:topic', 'update:message'])]
    private ?string $content = null;

    #[ORM\Column(type: 'boolean', options: ['default' => 0])]
    private bool $solved = false;

    #[ORM\Column(type: 'boolean', options: ['default' => 0])]
    private bool $sticky = false;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\ManyToMany(targetEntity: ForumTag::class, inversedBy: 'topics')]
    #[ORM\JoinTable(name: 'forum_topic_tag')]
    #[Assert\NotBlank]
    #[Count(min: 1, max: 3)]
    private Collection $tags;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private User $author;

    #[ORM\OneToMany(mappedBy: 'topic', targetEntity: ForumMessage::class)]
    private Collection $messages;

    #[ORM\ManyToOne(targetEntity: ForumMessage::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'SET NULL')]
    private ?ForumMessage $lastMessage = null;


    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->messages = new ArrayCollection();
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
     * @return ForumTopic
     */
    public function setId(?int $id): ForumTopic
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return ForumTopic
     */
    public function setName(string $name): ForumTopic
    {
        $this->name = $name;
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
     * @return ForumTopic
     */
    public function setContent(?string $content): ForumTopic
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSolved(): bool
    {
        return $this->solved;
    }

    /**
     * @param bool $solved
     * @return ForumTopic
     */
    public function setSolved(bool $solved): ForumTopic
    {
        $this->solved = $solved;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSticky(): bool
    {
        return $this->sticky;
    }

    /**
     * @param bool $sticky
     * @return ForumTopic
     */
    public function setSticky(bool $sticky): ForumTopic
    {
        $this->sticky = $sticky;
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
     * @return ForumTopic
     */
    public function setCreatedAt(?\DateTimeInterface $createdAt): ForumTopic
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
     * @return ForumTopic
     */
    public function setUpdatedAt(?\DateTimeInterface $updatedAt): ForumTopic
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return ArrayCollection|Collection
     */
    public function getTags(): ArrayCollection|Collection
    {
        return $this->tags;
    }

    /**
     * @param ArrayCollection|Collection $tags
     * @return ForumTopic
     */
    public function setTags(ArrayCollection|Collection $tags): ForumTopic
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return $this->author;
    }

    /**
     * @param User $author
     * @return ForumTopic
     */
    public function setAuthor(User $author): ForumTopic
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return ArrayCollection|Collection
     */
    public function getMessages(): ArrayCollection|Collection
    {
        return $this->messages;
    }

    /**
     * @param ArrayCollection|Collection $messages
     * @return ForumTopic
     */
    public function setMessages(ArrayCollection|Collection $messages): ForumTopic
    {
        $this->messages = $messages;
        return $this;
    }

    /**
     * @return ForumMessage|null
     */
    public function getLastMessage(): ?ForumMessage
    {
        return $this->lastMessage;
    }

    /**
     * @param ForumMessage|null $lastMessage
     * @return ForumTopic
     */
    public function setLastMessage(?ForumMessage $lastMessage): ForumTopic
    {
        $this->lastMessage = $lastMessage;
        return $this;
    }


}