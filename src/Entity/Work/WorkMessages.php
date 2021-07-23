<?php

namespace App\Entity\Work;

use App\Entity\Auth\User;
use Doctrine\DBAL\Types\Types;
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

#[Entity()]
#[Table('wip_message')]
class WorkMessages {


    #[Id]
    #[GeneratedValue(strategy: "IDENTITY")]
    #[Column(type: 'integer')]
    #[Groups(['read:message'])]
    private ?int $id;

    #[ManyToOne(targetEntity: User::class)]
    #[JoinColumn(name: 'user_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private User $author;

    #[Column(type: Types::TEXT)]
    #[NotBlank()]
    #[Length(min: 10)]
    #[Groups(['read:message', 'update:message'])]
    private string $content;

    #[Column(type: 'datetime')]
    private \DateTimeInterface $createdAt;

    #[Column(type: 'datetime')]
    private \DateTimeInterface $updatedAt;

    #[ManyToOne(targetEntity: WorkTopic::class, inversedBy: 'messages')]
    #[JoinColumn(name: 'topic_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private WorkTopic $topic;

    #[Column(type: 'boolean', options: ['default' => 1])]
    private bool $notification = true;

    #[Column(type: 'boolean', options: ['default' => 0])]
    private bool $accepted = false;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return WorkMessages
     */
    public function setId(?int $id): WorkMessages
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
     * @return WorkMessages
     */
    public function setAuthor(User $author): WorkMessages
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
     * @return WorkMessages
     */
    public function setContent(string $content): WorkMessages
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
     * @return WorkMessages
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): WorkMessages
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
     * @return WorkMessages
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt): WorkMessages
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return WorkTopic
     */
    public function getTopic(): WorkTopic
    {
        return $this->topic;
    }

    /**
     * @param WorkTopic $topic
     * @return WorkMessages
     */
    public function setTopic(WorkTopic $topic): WorkMessages
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
     * @return WorkMessages
     */
    public function setNotification(bool $notification): WorkMessages
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
     * @return WorkMessages
     */
    public function setAccepted(bool $accepted): WorkMessages
    {
        $this->accepted = $accepted;
        return $this;
    }



}