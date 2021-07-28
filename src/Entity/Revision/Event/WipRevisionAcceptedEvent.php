<?php

namespace App\Entity\Revision\Event;

use App\Entity\Revision\Revision;
use App\Entity\Revision\WipTagRevision;

class WipRevisionAcceptedEvent
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
