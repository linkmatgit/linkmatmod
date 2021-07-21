<?php

namespace App\Repository\Forum;



use App\Entity\Auth\User;
use App\Entity\Forum\Entity\ForumTag;
use App\Entity\Forum\Entity\ForumTopic;
use App\Infrastructure\Orm\AbstractRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @method ForumTopic|null find($id, $lockMode = null, $lockVersion = null)
 * @method ForumTopic|null findOneBy(array $criteria, array $orderBy = null)
 * @method ForumTopic[]    findAll()
 * @method ForumTopic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ForumTopicRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ForumTopic::class);
    }

    /**
     * Récupère les derniers sujets créés par l'utilisateur.
     *
     * @return ForumTopic[]
     */
    public function findLastByUser(User $user): array
    {
        return $this->createQueryBuilder('t')
            ->where('t.author = :user')
            ->orderBy('t.updatedAt', 'DESC')
            ->setMaxResults(5)
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();
    }

    /**
     * Récupère les derniers sujets sur lesquels l'utilisateur a participé.
     *
     * @return ForumTopic[]
     */
    public function findLastWithUser(User $user): array
    {
        return $this->createQueryBuilder('t')
            ->where('m.author = :user')
            ->andWhere('t.author != :user')
            ->join('t.messages', 'm')
            ->orderBy('t.updatedAt', 'DESC')
            ->groupBy('t.id')
            ->setMaxResults(5)
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();
    }

    /**
     * Récupère des sujets aléatoirement.
     */
    public function findRandom(int $limit): array
    {
        $date = new \DateTimeImmutable('-1 months');

        return $this->createQueryBuilder('t')
            ->andWhere('t.createdAt < :date')
            ->setParameter('date', $date)
            ->setMaxResults($limit)
            ->orderBy('RANDOM()')
            ->getQuery()
            ->getResult();
    }

    public function queryAllForTag(?ForumTag $tag): Query
    {
        $query = $this->createQueryBuilder('t')
            ->setMaxResults(20)
            ->orderBy('t.updatedAt', 'DESC');
        if ($tag) {
            $tags = [$tag];
            if ($tag->getChildren()->count() > 0) {
                $tags = $tag->getChildren()->toArray();
                $tags[] = $tag;
            }
            $query
                ->join('t.tags', 'tag')
                ->where('tag IN (:tags)')
                ->setParameter('tags', $tags);
        }

        return $query->getQuery();
    }

    public function findAllBatched(): iterable
    {
        $limit = 0;
        $perPage = 1000;
        while (true) {
            $rows = $this->createQueryBuilder('t')
                ->setMaxResults($perPage)
                ->setFirstResult($limit)
                ->getQuery()
                ->getResult();
            if (empty($rows)) {
                break;
            }
            foreach ($rows as $row) {
                yield $row;
            }
            $limit += $perPage;
            $this->getEntityManager()->clear();
        }
    }

    public function countForUser(User $user): int
    {
        return $this->count(['author' => $user]);
    }
}
