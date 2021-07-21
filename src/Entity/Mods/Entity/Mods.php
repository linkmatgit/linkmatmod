<?php

namespace App\Entity\Mods\Entity;


use App\Entity\Application\Entity\Content;
use App\Entity\Auth\User;
use App\Repository\ModsRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: ModsRepository::class)]
#[ORM\Table("mods_fs")]
class Mods extends Content {


    #[ORM\ManyToOne(targetEntity: ModsBrand::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'SET NULL')]
    private ModsBrand $brand;

    #[ORM\Column(type: 'string')]
    private string $price;

    #[ORM\ManyToMany(targetEntity: User::class)]
    #[ORM\JoinTable(name: 'mods_team_users')]
    private ?User $team = null;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $size = null;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $releaseDate;

    #[ORM\Column(type: Types::BOOLEAN, options: ['default' => 0])]
    private bool $support = false;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $version = null;

    #[ORM\Column(type: Types::STRING, unique: true, nullable: true)]
    private ?string $uri;

    #[ORM\ManyToOne(targetEntity: ModsCategory::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: 'SET NULL')]
    private ModsCategory $category;

    #[ORM\Column(type: Types::BOOLEAN, options: ['default' => 0])]

    private bool $public = false;

    /**
     * @return ModsBrand
     */
    public function getBrand(): ModsBrand
    {
        return $this->brand;
    }

    /**
     * @param ModsBrand $brand
     * @return Mods
     */
    public function setBrand(ModsBrand $brand): Mods
    {
        $this->brand = $brand;
        return $this;
    }



    /**
     * @return string
     */
    public function getPrice(): string
    {
        return $this->price;
    }

    /**
     * @param string $price
     * @return Mods
     */
    public function setPrice(string $price): Mods
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return Collection|null
     */
    public function getTeam(): ?Collection
    {
        return $this->team;
    }

    /**
     * @param Collection|null $team
     * @return Mods
     */
    public function setTeam(?Collection $team): Mods
    {
        $this->team = $team;
        return $this;
    }

    /**
     * @return string
     */
    public function getSize(): string
    {
        return $this->size;
    }

    /**
     * @param string $size
     * @return Mods
     */
    public function setSize(string $size): Mods
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getReleaseDate(): \DateTimeInterface
    {
        return $this->releaseDate;
    }

    /**
     * @param \DateTimeInterface $releaseDate
     * @return Mods
     */
    public function setReleaseDate(\DateTimeInterface $releaseDate): Mods
    {
        $this->releaseDate = $releaseDate;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSupport(): bool
    {
        return $this->support;
    }

    /**
     * @param bool $support
     * @return Mods
     */
    public function setSupport(bool $support): Mods
    {
        $this->support = $support;
        return $this;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @param string $version
     * @return Mods
     */
    public function setVersion(string $version): Mods
    {
        $this->version = $version;
        return $this;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @param string $uri
     * @return Mods
     */
    public function setUri(string $uri): Mods
    {
        $this->uri = $uri;
        return $this;
    }

    /**
     * @return ModsCategory
     */
    public function getCategory(): ModsCategory
    {
        return $this->category;
    }

    /**
     * @param ModsCategory $category
     * @return Mods
     */
    public function setCategory(ModsCategory $category): Mods
    {
        $this->category = $category;
        return $this;
    }
    /**
     * @return bool
     */
    public function isPublic(): bool
    {
        return $this->public;
    }

    /**
     * @param bool $public
     * @return Mods
     */
    public function setPublic(bool $public): Mods
    {
        $this->public = $public;
        return $this;
    }

}