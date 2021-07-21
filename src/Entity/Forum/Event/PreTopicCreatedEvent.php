<?php

namespace App\Entity\Forum\Event;



use App\Entity\Forum\Entity\ForumTopic;

class PreTopicCreatedEvent
{


    public function __construct(
        private ForumTopic $topic
    )
    {

    }

    /**
     * @return ForumTopic
     */
    public function getTopic(): ForumTopic
    {
        return $this->topic;
    }




}