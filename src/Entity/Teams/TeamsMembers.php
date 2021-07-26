<?php

namespace App\Entity\Teams;
use App\Entity\Auth\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[UniqueEntity(fields: "name", message: 'Une autres Team porte deja ce noms')]
#[ORM\Entity()]
#[ORM\Table(name: 'teams_members')]
class TeamsMembers
{
    use  RankTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id = null;


    #[ORM\ManyToOne(targetEntity: Teams::class, inversedBy: 'members')]
    private Teams $teams;

    #[ORM\OneToMany(mappedBy: 'teams', targetEntity: User::class)]
    private ?Collection $members;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $joinAt = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $askFor =  null;

    #[ORM\Column(type: Types::BOOLEAN, options: ['default' => false])]
    private bool $accept;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $abouthim = null;

    public function __construct()
    {
        $this->members = new ArrayCollection();
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
     * @return TeamsMembers
     */
    public function setId(?int $id): TeamsMembers
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Teams
     */
    public function getTeams(): Teams
    {
        return $this->teams;
    }

    /**
     * @param Teams $teams
     * @return TeamsMembers
     */
    public function setTeams(Teams $teams): TeamsMembers
    {
        $this->teams = $teams;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getMembers(): Collection
    {
        return $this->members;
    }

    /**
     * @param Collection $members
     * @return TeamsMembers
     */
    public function setMembers(Collection $members): TeamsMembers
    {
        $this->members = $members;
        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getJoinAt(): ?\DateTimeInterface
    {
        return $this->joinAt;
    }

    /**
     * @param \DateTimeInterface|null $joinAt
     * @return TeamsMembers
     */
    public function setJoinAt(?\DateTimeInterface $joinAt): TeamsMembers
    {
        $this->joinAt = $joinAt;
        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getAskFor(): ?\DateTimeInterface
    {
        return $this->askFor;
    }

    /**
     * @param \DateTimeInterface|null $askFor
     * @return TeamsMembers
     */
    public function setAskFor(?\DateTimeInterface $askFor): TeamsMembers
    {
        $this->askFor = $askFor;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAccept(): bool
    {
        return $this->accept;
    }

    /**
     * @param bool $accept
     * @return TeamsMembers
     */
    public function setAccept(bool $accept): TeamsMembers
    {
        $this->accept = $accept;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAbouthim(): ?string
    {
        return $this->abouthim;
    }

    /**
     * @param string|null $abouthim
     * @return TeamsMembers
     */
    public function setAbouthim(?string $abouthim): TeamsMembers
    {
        $this->abouthim = $abouthim;
        return $this;
    }


}