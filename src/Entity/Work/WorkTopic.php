<?php

namespace App\Entity\Work;

use ApiPlatform\Core\Annotation\ApiProperty;
use App\Entity\Auth\User;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity()]
#[ORM\Table('wip_topic')]
class WorkTopic
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ApiProperty(identifier: true)]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id;

    #[Assert\NotBlank]
    #[ORM\Column(type: Types::STRING)]
    private string $name;

    #[Assert\NotBlank]
    #[ORM\Column(type: Types::TEXT)]
    private string $content;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: false)]
    private \DateTimeInterface $createdAt;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private User $author;

    #[ORM\ManyToOne(targetEntity: Work::class, inversedBy: 'topics')]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private Collection $tags;

    #[ORM\OneToMany(mappedBy: 'topic', targetEntity: WorkMessages::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private Collection $messages;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->messages = new ArrayCollection();
    }


    /**
     * @param ArrayCollection|Collection $tags
     * @return WorkTopic
     */
    public function setTags(ArrayCollection|Collection $tags): WorkTopic
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @return Collection|Work]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Work $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    public function removeTag(Work $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
        }

        return $this;
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

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return WorkTopic
     */
    public function setId(?int $id): WorkTopic
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
     * @return WorkTopic
     */
    public function setName(string $name): WorkTopic
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return WorkTopic
     */
    public function setContent(string $content): WorkTopic
    {
        $this->content = $content;
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
     * @return WorkTopic
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): WorkTopic
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
     * @return WorkTopic
     */
    public function setUpdatedAt(?\DateTimeInterface $updatedAt): WorkTopic
    {
        $this->updatedAt = $updatedAt;
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
     * @return WorkTopic
     */
    public function setAuthor(User $author): WorkTopic
    {
        $this->author = $author;
        return $this;
    }



}