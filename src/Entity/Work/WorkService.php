<?php declare(strict_types=1);

namespace App\Entity\Work;

use App\Entity\Work\Data\WorkData;
use Doctrine\ORM\EntityManagerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;

class WorkService {

    public function __construct(
        private EventDispatcherInterface $dispatcher,
        private EntityManagerInterface $em
    )
    {
    }

    public function createWip(WorkData $work){
        $work->setCreatedAt(new \DateTime());
        $this->dispatcher->dispatch(null );
        $this->em->persist($work);
        $this->em->flush();
    }


}