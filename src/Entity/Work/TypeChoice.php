<?php

namespace App\Entity\Work;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


const OUVERT = 1;
const FERMER = 2;

const PENDING = 0;
const APPROUVER = 1;
const DECLINE = 2;
const REVISION = 3;



const NONRESPECT =  0;
const COPIEDEMODE = 1;
const PASVOTRETRAVAIL = 2;
const MANQUEDINFO = 3;


trait TypeChoice
{
    #[ORM\Column(type: Types::SMALLINT, options: ['default'=> -1])]
    private int $statut = 0;

    #[ORM\Column(type: Types::SMALLINT, options: ['default'=> 0])]
    private int $approved = 0;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $reason = null;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?string $reasonType = null;

    public static array $confirm = [
        PENDING => 'EN ATTENTE',
        APPROUVER =>'APPROUVER',
        DECLINE => 'REFUSER',
        REVISION => 'REVISION'
    ];


    public static array $reasonTypes = [
        NONRESPECT => 'Le Mod ne correspond pas au attente de qualité definie par les CGU',
        COPIEDEMODE =>'Votre Mod a ete Copie d\'un autre mod ',
        PASVOTRETRAVAIL => 'Ce Mod ne vous appartien pas',
        MANQUEDINFO => 'Pas assez de details'
    ];

    public static array $status = [
        OUVERT => 'Ouvert',
        FERMER => 'Fermé',
    ];

    /**
     * @return int
     */
    public function getApproved(): int
    {
        return $this->approved;
    }

    /**
     * @param int $approved
     * @return TypeChoice|\App\Entity\Teams\Teams|Work|WorkTopic
     */
    public function setApproved(int $approved): self
    {
        $this->approved = $approved;
        return $this;
    }

    public function getApprouveName() {
        return self::$confirm[$this->approved];
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

    /**
     * @return string|null
     */
    public function getReason(): ?string
    {
        return $this->reason;
    }

    /**
     * @param string|null $reason
     * @return TypeChoice
     */
    public function setReason(?string $reason): self
    {
        $this->reason = $reason;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getReasonType(): ?string
    {
        return $this->reasonType;
    }
    public function getReasonTypeName(): string {
        return self::$reasonTypes[$this->reasonType];
    }

    /**
     * @param string|null $reasonType
     * @return TypeChoice|\App\Entity\Teams\Teams|Work|WorkTopic
     */
    public function setReasonType(?string $reasonType): self
    {
        $this->reasonType = $reasonType;
        return $this;
    }


}