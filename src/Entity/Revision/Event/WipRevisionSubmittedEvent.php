<?php

namespace App\Entity\Revision\Event;


use App\Entity\Revision\WipTagRevision;

class WipRevisionSubmittedEvent
{
    private WipTagRevision $revision;

    public function __construct(WipTagRevision $revision)
    {
        $this->revision = $revision;
    }

    public function getRevision(): WipTagRevision
    {
        return $this->revision;
    }
}
