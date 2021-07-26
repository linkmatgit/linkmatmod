<?php

namespace App\Entity\Teams;

    use Doctrine\DBAL\Types\Types;
    use Doctrine\ORM\Mapping as ORM;

    const RECRUE = 0;
    const MEMBRE = 1;
    const CHEF = 2;
    const MAPPEUR = 3;
    const MODDEUR = 4;
    const SCRIPTEUR = 5;
    const TESTEUR = 6;

trait RankTrait
{
    #[ORM\Column(type: Types::SMALLINT, options: ['default'=> -1])]
    private int $rang = 0;

    public static array $ranks = [
        RECRUE => 'Recrue',
        MEMBRE => 'Membre',
        CHEF => 'Chef de projet',
        MAPPEUR => 'Créateur de maps',
        MODDEUR => 'Créateur de mods',
        SCRIPTEUR => 'Script Mods/Maps',
        TESTEUR => 'Beta Testeur',
        ];
    public function getRang(): int
    {
        return $this->rang;
    }

    public function getRankName(): string {
        return self::$ranks[$this->rang];
    }

    public function setRang(int $rang): self
    {
        $this->rang = $rang;
        return $this;
    }

}