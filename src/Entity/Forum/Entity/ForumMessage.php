<?php

namespace App\Entity\Forum\Entity;


use App\Entity\Auth\User;
use App\Repository\Forum\ForumMessageRepository;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

#[Entity(repositoryClass: ForumMessageRepository::class)]
#[Table('forum_message')]
class ForumMessage {


    #[Id]
    #[GeneratedValue(strategy: "IDENTITY")]
    #[Column(type: 'integer')]
    #[Groups(['read:message'])]
    private ?int $id;

    #[ManyToOne(targetEntity: User::class)]
    #[JoinColumn(name: 'user_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private User $author;

    #[Column(type: 'text')]
    #[NotBlank()]
    #[Length(min: 10)]
    #[Groups(['read:message', 'update:message'])]
    private string $content;

    #[Column(type: 'datetime')]
    private \DateTimeInterface $createdAt;

    #[Column(type: 'datetime')]
    private \DateTimeInterface $updatedAt;

    #[ManyToOne(targetEntity: ForumTopic::class, inversedBy: 'messages')]
    #[JoinColumn(name: 'topic_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private ForumTopic $topic;

    #[Column(type: 'boolean', options: ['default' => 1])]
    private bool $notification = true;

    #[Column(type: 'boolean', options: ['default' => 0])]
    private bool $accepted = false;



    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return ForumMessage
     */
    public function setId(?int $id): ForumMessage
    {
        $this->id = $id;
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
     * @return ForumMessage
     */
    public function setAuthor(User $author): ForumMessage
    {
        $this->author = $author;
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
     * @return ForumMessage
     */
    public function setContent(string $content): ForumMessage
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
     * @return ForumMessage
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): ForumMessage
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
     * @return ForumMessage
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt): ForumMessage
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return ForumTopic
     */
    public function getTopic(): ForumTopic
    {
        return $this->topic;
    }

    /**
     * @param ForumTopic $topic
     * @return ForumMessage
     */
    public function setTopic(ForumTopic $topic): ForumMessage
    {
        $this->topic = $topic;
        return $this;
    }

    /**
     * @return bool
     */
    public function isNotification(): bool
    {
        return $this->notification;
    }

    /**
     * @param bool $notification
     * @return ForumMessage
     */
    public function setNotification(bool $notification): ForumMessage
    {
        $this->notification = $notification;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAccepted(): bool
    {
        return $this->accepted;
    }

    /**
     * @param bool $accepted
     * @return ForumMessage
     */
    public function setAccepted(bool $accepted): ForumMessage
    {
        $this->accepted = $accepted;
        return $this;
    }


}