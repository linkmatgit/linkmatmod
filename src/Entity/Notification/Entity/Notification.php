<?php

namespace App\Entity\Notification\Entity;


use App\Entity\Auth\User;

use Doctrine\DBAL\Types\Types;
use Symfony\Component\Validator\Constraints\NotBlank;
use Doctrine\ORM\Mapping AS ORM;

#[ORM\Entity]
class Notification{

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'user_id', nullable: true, onDelete: 'CASCADE')]
    private ?User $user = null;

    #[ORM\Column(type: Types::STRING)]
    #[NotBlank]
    private string $message;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $url = null;

    #[ORM\Column(type:  Types::DATETIME_IMMUTABLE)]
    private \DateTimeInterface $createdAt;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $chanel = 'public';

    #[ORM\Column(Types::STRING, nullable: true)]
    private ?string $target = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Notification
     */
    public function setId(?int $id): Notification
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User|null $user
     * @return Notification
     */
    public function setUser(?User $user): Notification
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return Notification
     */
    public function setMessage(string $message): Notification
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string|null $url
     * @return Notification
     */
    public function setUrl(?string $url): Notification
    {
        $this->url = $url;
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
     * @return Notification
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): Notification
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getChanel(): ?string
    {
        return $this->chanel;
    }

    /**
     * @param string|null $chanel
     * @return Notification
     */
    public function setChanel(?string $chanel): Notification
    {
        $this->chanel = $chanel;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTarget(): ?string
    {
        return $this->target;
    }

    /**
     * @param string|null $target
     * @return Notification
     */
    public function setTarget(?string $target): Notification
    {
        $this->target = $target;
        return $this;
    }


}

