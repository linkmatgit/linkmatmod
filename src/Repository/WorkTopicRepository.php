<?php

namespace App\Repository;

use App\Entity\Auth\User;
use App\Entity\Blog\Post;
use App\Entity\Work\Work;
use App\Entity\Work\WorkTopic;
use App\Infrastructure\Orm\AbstractRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WorkTopic|null find($id, $lockMode = null, $lockVersion = null)
 * @method WorkTopic|null findOneBy(array $criteria, array $orderBy = null)
 * @method WorkTopic[]    findAll()
 * @method WorkTopic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
/**
 * @extends AbstractRepository<Post>
 */
class WorkTopicRepository extends AbstractRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WorkTopic::class);
    }
    /**
     * Force l'hydratation des messages (pour éviter de faire n+1 requêtes).
     */
    public function queryAllForTag(?Work $tag): Query
    {
        $query = $this->createQueryBuilder('t')
            ->where('t.spam = false')
            ->setMaxResults(20)
            ->orderBy('t.updatedAt', 'DESC');
        if ($tag) {
            $tags = [$tag];
            $query
                ->join('t.work', 'work')
                ->where('work IN (:work)')
                ->setParameter('work', $tags);
        }

        return $query->getQuery();
    }

}
