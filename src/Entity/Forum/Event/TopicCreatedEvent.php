<?php

namespace App\Entity\Forum\Event;



use App\Entity\Forum\Entity\ForumTopic;

class TopicCreatedEvent
{


    public function __construct(
        private ForumTopic $topic
    )
    {

    }

    public function getTopic(): ForumTopic
    {
        return $this->topic;
    }
}