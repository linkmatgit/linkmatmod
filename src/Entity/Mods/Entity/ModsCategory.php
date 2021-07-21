<?php

namespace App\Entity\Mods\Entity;


use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table("mods_category")]
class ModsCategory {

    #[Id]
    #[GeneratedValue(strategy: "IDENTITY")]
    #[Column(type: 'integer')]
    private ?int $id = null;

    #[Column(type: 'string')]
    private string $name;

    #[Column(type: 'text')]
    private string $description;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return ModsCategory
     */
    public function setId(?int $id): ModsCategory
    {
        $this->id = $id;
        return $this;
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
     * @return ModsCategory
     */
    public function setName(string $name): ModsCategory
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
     * @return ModsCategory
     */
    public function setDescription(string $description): ModsCategory
    {
        $this->description = $description;
        return $this;
    }

}