<?php

namespace App\Entity\Work;

use ApiPlatform\Core\Annotation\ApiProperty;
use App\Entity\Auth\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity()]
#[ORM\Table(name: 'wip_topic')]
class WorkTopic
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ApiProperty(identifier: true)]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id = null;


    #[ORM\Column(type: Types::STRING, length: 70)]
    #[Assert\NotBlank()]
    #[Assert\Length(min: 5, max: 70)]
    #[Groups(['read:worktopic'])]
    private string $name = '';

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank()]
    #[Groups(['read:worktopic'])]
    private ?string $content = null;

    #[ORM\Column(type: Types::BOOLEAN, options: ['default' => false])]
    private ?bool $solved = false;

    #[ORM\Column(type: Types::BOOLEAN, options: ['default' => false])]
    private ?bool $sticky = false;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $updatedAt = null;


    #[ORM\ManyToOne(targetEntity: Work::class, inversedBy: 'topics')]
    private Work $tags;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private User $author;


    #[ORM\Column(type: Types::INTEGER, options: ['default' => 0])]
    private int $messageCount = 0;


    #[ORM\OneToMany(mappedBy: 'topic', targetEntity: WorkMessages::class)]
    #[ORM\OrderBy(['accepted' => 'DESC', 'createdAt' => 'ASC'])]
    private Collection $messages;


    #[ORM\ManyToOne(targetEntity: WorkMessages::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'SET NULL')]
    private ?WorkMessages $lastMessage = null;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name ?: '';

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content ?: '';

        return $this;
    }

    public function isSolved(): ?bool
    {
        return $this->solved;
    }

    public function setSolved(bool $solved): self
    {
        $this->solved = $solved;

        return $this;
    }

    public function getSticky(): ?bool
    {
        return $this->sticky;
    }

    public function setSticky(bool $sticky): self
    {
        $this->sticky = $sticky;

        return $this;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt ?: new \DateTime();
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getAuthor(): User
    {
        return $this->author;
    }

    public function setAuthor(User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getMessageCount(): ?int
    {
        return $this->messageCount;
    }

    public function setMessageCount(int $messageCount): self
    {
        $this->messageCount = $messageCount;

        return $this;
    }

    public function getLastMessage(): ?WorkMessages
    {
        return $this->lastMessage;
    }

    /**
     * @return Collection|WorkMessages[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(WorkMessages $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages->add($message);
            $message->setTopic($this);
        }

        return $this;
    }

    /**
     * @param Collection|WorkMessages[] $messages
     */
    public function setMessages(Collection $messages): self
    {
        $this->messages = $messages;

        return $this;
    }

    public function setLastMessage(?WorkMessages $lastMessage): self
    {
        $this->lastMessage = $lastMessage;

        return $this;
    }

    public function isLocked(): bool
    {
        return $this->getCreatedAt() < (new \DateTime('-6 month'));
    }

    /**
     * @return Work
     */
    public function getTags(): Work
    {
        return $this->tags;
    }

    /**
     * @param Work $tags
     * @return WorkTopic
     */
    public function setTags(Work $tags): self
    {
        $this->tags = $tags;
        return $this;
    }




}