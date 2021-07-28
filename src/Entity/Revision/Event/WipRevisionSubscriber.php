<?php declare(strict_types=1);

namespace App\Entity\Revision\Event;

use App\Entity\Revision\WipTagRevision;
use App\Entity\Work\Event\WorkUpdatedEvent;
use Doctrine\ORM\EntityManagerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class WipRevisionSubscriber implements EventSubscriberInterface
{


    public function __construct(
        private EntityManagerInterface $em,
        private EventDispatcherInterface $dispatcher)
    {

    }

    public static function getSubscribedEvents(): array
    {
        return [
            WipRevisionRefusedEvent::class => 'onRevisionRefused',
            WipRevisionAcceptedEvent::class => 'onRevisionAccepted',
        ];
    }

    public function onRevisionRefused(WipRevisionRefusedEvent $event): void
    {
        $event->getRevision()->setStatus(WipTagRevision::REJECTED);
        $event->getRevision()->setContent('');
        $this->em->flush();
    }

    public function onRevisionAccepted(WipRevisionAcceptedEvent $event): void
    {
        $content = $event->getRevision()->getTarget();
        $previous = clone $content;
        $content->setContent($event->getRevision()->getContent());
        $event->getRevision()->setStatus(WipTagRevision::ACCEPTED);
        $event->getRevision()->setContent('');
        $this->em->flush();
        $this->dispatcher->dispatch(new WorkUpdatedEvent($content, $previous));
    }
}