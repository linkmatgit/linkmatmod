<?php

namespace App\Entity\Forum;


use App\Entity\Forum\Entity\ForumTopic;
use App\Entity\Forum\Event\PreTopicCreatedEvent;
use App\Entity\Forum\Event\TopicCreatedEvent;
use Doctrine\ORM\EntityManagerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;

class TopicService
{
    private EventDispatcherInterface $dispatcher;
    private EntityManagerInterface $em;

    public function __construct(EventDispatcherInterface $dispatcher, EntityManagerInterface $em)
    {
        $this->dispatcher = $dispatcher;
        $this->em = $em;
    }

    /**
     * Crée un nouveau sujet.
     */
    public function createTopic(ForumTopic $topic): void
    {
        $topic->setCreatedAt(new \DateTime());
        $topic->setUpdatedAt(new \DateTime());
        $this->dispatcher->dispatch(new PreTopicCreatedEvent($topic));
        $this->em->persist($topic);
        $this->em->flush();
        $this->dispatcher->dispatch(new TopicCreatedEvent($topic));
    }


}