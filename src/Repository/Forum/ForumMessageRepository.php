<?php

namespace App\Repository\Forum;


use App\Entity\Forum\Entity\ForumMessage;
use App\Entity\Forum\Entity\ForumTopic;
use App\Infrastructure\Orm\AbstractRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @method ForumMessage|null find($id, $lockMode = null, $lockVersion = null)
 * @method ForumMessage|null findOneBy(array $criteria, array $orderBy = null)
 * @method ForumMessage[]    findAll()
 * @method ForumMessage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ForumMessageRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ForumMessage::class);
    }

    public function hydrateMessages(ForumTopic $topic): ForumTopic
    {
        $messages = $this->createQueryBuilder('m')
            ->where('m.topic = :topic')
            ->join('m.author', 'u')
            ->select('m, partial u.{id, username, email}')
            ->setParameter('topic', $topic)
            ->orderBy('m.accepted', 'DESC')
            ->addOrderBy('m.createdAt', 'ASC')
            ->getQuery()
            ->getResult();
        $topic->setMessages(new ArrayCollection($messages));

        return $topic;
    }
}
