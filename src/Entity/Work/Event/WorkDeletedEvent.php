<?php

namespace App\Entity\Work\Event;

use App\Entity\Work\Work;

class WorkDeletedEvent
{
    private Work $content;
    private Work $previous;

    public function __construct(Work $content, Work $previous)
    {
        $this->content = $content;
        $this->previous = $previous;
    }

    public function getContent(): Work
    {
        return $this->content;
    }

    public function getPrevious(): Work
    {
        return $this->previous;
    }
}
