<?php declare(strict_types=1);

namespace App\Entity\Work\Data;


use App\Entity\Auth\User;
use App\Entity\Work\Work;

class WorkData {

    public string $title;

    public string $content;

    public bool $online = true;

    public int $status =  0;

    public User $author;

    public \DateTimeInterface $createdAt;

    public function __construct(Work $rows)
    {
        $this->title = $rows->getTitle();
        $this->content = $rows->getContent();
        $this->author = $rows->getAuthor();
        $this->createdAt = $rows->getCreatedAt();

    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return WorkData
     */
    public function setTitle(string $title): WorkData
    {
        $this->title = $title;
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
     * @return WorkData
     */
    public function setContent(string $content): WorkData
    {
        $this->content = $content;
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
     * @return WorkData
     */
    public function setOnline(bool $online): WorkData
    {
        $this->online = $online;
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
     * @return WorkData
     */
    public function setStatus(int $status): WorkData
    {
        $this->status = $status;
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
     * @return WorkData
     */
    public function setAuthor(?User $author): WorkData
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
     * @return WorkData
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): WorkData
    {
        $this->createdAt = $createdAt;
        return $this;
    }



}