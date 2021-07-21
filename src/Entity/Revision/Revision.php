<?php

namespace App\Entity\Revision;

use App\Entity\Application\Entity\Content;
use App\Entity\Auth\User;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

#[Entity()]
class Revision
{

    const PENDING = 0;
    const ACCEPTED = 1;
    const REJECTED = 2;

    #[Id]
    #[GeneratedValue(strategy: "IDENTITY")]
    #[Column(type: 'integer')]
    private ?int $id = null;

    #[ManyToOne(targetEntity: User::class)]
    #[JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private User $author;

    #[ManyToOne(targetEntity: Content::class)]
    #[JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private Content $target;

    #[Column(type: 'string')]
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
     * @return Revision
     */
    public function setId(?int $id): Revision
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
     * @return Revision
     */
    public function setAuthor(User $author): Revision
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return Content
     */
    public function getTarget(): Content
    {
        return $this->target;
    }

    /**
     * @param Content $target
     * @return Revision
     */
    public function setTarget(Content $target): Revision
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
     * @return Revision
     */
    public function setContent(string $content): Revision
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
     * @return Revision
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): Revision
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
     * @return Revision
     */
    public function setStatus(int $status): Revision
    {
        $this->status = $status;
        return $this;
    }


}