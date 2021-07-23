<?php

namespace App\Entity\Config;

use App\Repository\ConfigurationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;


#[Entity(repositoryClass: ConfigurationRepository::class, readOnly: false)]
class Configuration
{
    #[Id]
    #[GeneratedValue(strategy: "IDENTITY")]
    #[Column(type: Types::INTEGER)]
    private ?int $id = null;

    #[Column(type: Types::STRING, nullable: true)]
    private ?string $title = null;

    #[Column(type: Types::STRING, nullable: true)]
    private ?string $colorHeader =  null;

   #[Column(type: Types::STRING, nullable: true)]
    private ?string $colorFooter = null;

    #[Column(type: Types::STRING, nullable: true)]
    private ?string $copyright = null;

    #[Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Configuration
     */
    public function setId(?int $id): Configuration
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return Configuration
     */
    public function setTitle(?string $title): Configuration
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getColorHeader(): ?string
    {
        return $this->colorHeader;
    }

    /**
     * @param string|null $colorHeader
     * @return Configuration
     */
    public function setColorHeader(?string $colorHeader): Configuration
    {
        $this->colorHeader = $colorHeader;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getColorFooter(): ?string
    {
        return $this->colorFooter;
    }

    /**
     * @param string|null $colorFooter
     * @return Configuration
     */
    public function setColorFooter(?string $colorFooter): Configuration
    {
        $this->colorFooter = $colorFooter;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCopyright(): ?string
    {
        return $this->copyright;
    }

    /**
     * @param string|null $copyright
     * @return Configuration
     */
    public function setCopyright(?string $copyright): Configuration
    {
        $this->copyright = $copyright;
        return $this;
    }
    /**
     * @return \DateTimeInterface|null
     */
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTimeInterface|null $updatedAt
     * @return Configuration
     */
    public function setUpdatedAt(?\DateTimeInterface $updatedAt): Configuration
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }


}
