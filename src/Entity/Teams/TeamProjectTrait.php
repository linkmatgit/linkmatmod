<?php

namespace App\Entity\Teams;

use Doctrine\ORM\Mapping as ORM;


trait TeamProjectTrait
{

    #[ORM\ManyToOne(targetEntity: Teams::class, inversedBy: 'project')]
    #[ORM\JoinColumn(nullable: true, onDelete: 'CASCADE')]
    private ?Teams $teams = null;

    /**
     * @return Teams|null
     */
    public function getTeams(): ?Teams
    {
        return $this->teams;
    }

    /**
     * @param Teams|null $teams
     * @return TeamProjectTrait
     */
    public function setTeams(?Teams $teams): self
    {
        $this->teams = $teams;
        return $this;
    }



}