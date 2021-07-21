<?php

namespace App\Entity\Mods\Entity;


use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table("mods_brand")]
class ModsBrand {

    #[Id]
    #[GeneratedValue(strategy: "IDENTITY")]
    #[Column(type: 'integer')]
    private ?int $id = null;

    #[Column(type: 'string')]
    private string $name;

    #[Column(type: 'string')]
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
     * @return ModsBrand
     */
    public function setId(?int $id): ModsBrand
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
     * @return ModsBrand
     */
    public function setName(string $name): ModsBrand
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
     * @return ModsBrand
     */
    public function setDescription(string $description): ModsBrand
    {
        $this->description = $description;
        return $this;
    }

}