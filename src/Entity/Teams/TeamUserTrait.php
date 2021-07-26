<?php

namespace App\Entity\Teams;

use Doctrine\ORM\Mapping as ORM;


trait TeamUserTrait
{

    #[ORM\ManyToOne(targetEntity: TeamsMembers::class, inversedBy: 'members')]
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
     * @return \App\Entity\Auth\User|TeamUserTrait
     */
    public function setTeams(?Teams $teams): self
    {
        $this->teams = $teams;
        return $this;
    }




}