<?php

namespace App\Entity\Work;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


const OUVERT = 1;
const FERMER = 2;

const PENDING = false;
const APPROUVER = true;


trait TypeChoice
{
    #[ORM\Column(type: Types::SMALLINT, options: ['default'=> -1])]
    private int $statut = 0;

    #[ORM\Column(type: 'boolean', options: ['default' => 0])]
    private bool $approved =  false;

    public static array $confirm = [
        PENDING => 'EN ATTENTE',
        APPROUVER =>'Approuver',
    ];

    public static array $status = [
        OUVERT => 'Ouvert',
        FERMER => 'Fermé',
    ];
    public function getApprouveName() {
        return self::$confirm[$this->approved];
    }
    /**
     * @return bool
     */
    public function isApproved(): bool
    {
        return $this->approved;
    }

    /**
     * @param bool $approved
     * @return Work
     */
    public function setApproved(bool $approved): Work
    {
        $this->approved = $approved;
        return $this;
    }

    public function getStatut(): int
    {
        return $this->statut;
    }

    public function getTypeName(): string {
        return self::$status[$this->statut];
    }

    public function setStatut(int $statut): self
    {
        $this->statut = $statut;
        return $this;
    }





}