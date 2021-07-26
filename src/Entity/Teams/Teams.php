<?php

namespace App\Entity\Teams;

use App\Entity\Auth\User;
use App\Entity\Manager\ManageableTrait;
use App\Entity\Work\TypeChoice;
use App\Entity\Work\Work;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[UniqueEntity(fields: "name", message: 'Une autres Team porte deja ce noms')]
#[UniqueEntity(fields: "author", message: 'Tu a deja une Team')]
#[ORM\Entity()]
#[ORM\Table(name: 'teams')]
class Teams
{
    use TypeChoice;
    use ManageableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id = null;


    #[ORM\Column(type: Types::STRING, length: 70)]
    private string $name;

    #[ORM\Column(type: Types::TEXT)]
    private string $description;

    #[ORM\Column(type: Types::TEXT)]
    private string $about;

    #[ORM\Column(type: Types::STRING, length: 2, nullable: true, options: ["default" => 'FR'])]
    private ?string $country = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private User $author;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $createdAt;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $updatedAt;

    #[ORM\OneToMany(mappedBy: 'teams', targetEntity: TeamsMembers::class)]
    private ?Collection $members;

    #[ORM\OneToMany(mappedBy: 'teams', targetEntity: Work::class)]
    private ?Collection $project;


    public function __construct()
    {
        $this->project = new ArrayCollection();
        $this->members = new ArrayCollection();

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
     * @return Teams
     */
    public function setName(string $name): Teams
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Teams
     */
    public function setDescription(string $description): Teams
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return Teams
     */
    public function setCountry(string $country): Teams
    {
        $this->country = $country;
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
     * @return Teams
     */
    public function setAuthor(User $author): Teams
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
     * @return Teams
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): Teams
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
     * @return Teams
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt): Teams
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }


    public function getMembers(): Collection {
        return $this->members;
    }
    public function addMember(TeamsMembers $members): self {
        if(!$this->members->contains($members)) {
            $this->members[] = $members;
            $members->setTeams($this);
        }
        return $this;
    }

    public function removeMember(TeamsMembers $members): self {
        if ($this->members->removeElement($members)) {
            if($members->getTeams() === $this) {
                $members->setTeams(null);
            }
        }
        return $this;
    }

    public function getProject(): Collection {
        return $this->project;
    }
    public function addProject(Work $work): self {
        if(!$this->project->contains($work)) {
            $this->project[] = $work;
            $work->setTeams($this);
        }
        return $this;
    }

    public function removeProject(Work $work): self {
        if ($this->project->removeElement($work)) {
            if($work->getTeams() === $this) {
                $work->setTeams($this);
            }
        }
        return $this;
    }

}