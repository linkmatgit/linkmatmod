<?php

namespace App\Entity\Revision;


use App\Entity\Auth\User;
use App\Entity\Revision\Constraint\NotSameContent;
use App\Entity\Work\Work;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Symfony\Component\Validator\Constraints\NotBlank;

#[Entity()]
#[NotSameContent()]
#[Table('wiptag_revision')]
class WipTagRevision
{

    const PENDING = 0;
    const ACCEPTED = 1;
    const REJECTED = 2;

    #[Id]
    #[NotBlank]
    #[GeneratedValue(strategy: "IDENTITY")]
    #[Column(type: 'integer')]
    private ?int $id = null;

    #[ManyToOne(targetEntity: User::class)]
    #[JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private User $author;

    #[ManyToOne(targetEntity: Work::class)]
    #[JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private Work $target;

    #[Column(type: Types::TEXT)]
    private string $content = "";

    #[Column(type: 'datetime', nullable: true)]
    private \DateTimeInterface $createdAt;

    #[Column(type: 'boolean', length: 1,options: ['default' => 0])]
    private int $status = self::PENDING;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return WipTagRevision
     */
    public function setId(?int $id): self
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
     * @return WipTagRevision
     */
    public function setAuthor(User $author): self
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return Work
     */
    public function getTarget(): Work
    {
        return $this->target;
    }

    /**
     * @param Work $target
     * @return WipTagRevision
     */
    public function setTarget(Work $target): self
    {
        $this->target = $target;
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
     * @return WipTagRevision
     */
    public function setContent(string $content): self
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
     * @return WipTagRevision
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return WipTagRevision
     */
    public function setStatus(int $status): self
    {
        $this->status = $status;
        return $this;
    }


}