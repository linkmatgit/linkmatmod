<?php

namespace App\Entity\Manager;

use App\Entity\Auth\User;


use Doctrine\ORM\Mapping as ORM;

trait ManageableTrait
{

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    public ?User $approuveBy = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    public ?\DateTimeInterface $approuvedAt = null;

    /**
     * @return User|null
     */
    public function getApprouveBy(): ?User
    {
        return $this->approuveBy;
    }

    /**
     * @param User|null $approuveBy

     */
    public function setApprouveBy(?User $approuveBy): self
    {
        $this->approuveBy = $approuveBy;
        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getApprouvedAt(): ?\DateTimeInterface
    {
        return $this->approuvedAt;
    }

    /**
     * @param \DateTimeInterface|null $approuvedAtt
     */
    public function setApprouvedAt(?\DateTimeInterface $approuvedAt): self
    {
        $this->approuvedAt = $approuvedAt;
        return $this;
    }







}